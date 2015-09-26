<?php
// * * * * * /var/www/html/webcore/bin/cake OneMinute >> /var/www/html/webcore/tmp/logs/cron.log
namespace App\Shell;
use Cake\Console\Shell;
use Cake\Network\Email\Email;
use Cake\ORM\TableRegistry;

/**
 * OneMinute shell command.
 */
class OneMinuteShell extends Shell
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('EmailStacks');
        $this->loadModel('News');

    }
    
    /**
     * main() method.
     *
     * @return bool|int Success or error code.
     */
    public function main()
    {
        $this->sendMail();
        $this->crawlerSSC();
    }
    
    /**
     * Check email in stack and send to user
     * @throws Exception
     * @return void
     */
    public function sendMail()
    {
        $mails = $this->EmailStacks->find()->where(['sent'=>false]);
        
        $dataResult = [];
        foreach ($mails as $row) 
        {
            $email = new Email('default');
            
            if($email->to($row->email)->subject($row->subject)->send($row->content))
            {
                $ent = $this->EmailStacks->get($row->id);
                $ent->sent = true;
                $this->EmailStacks->save($ent);
            }
        }
    }

    public function crawlerSSC($id = null){
        $data = file_get_html("http://congbothongtin.ssc.gov.vn/web/guest/3?p_p_id=InformationPublished_WAR_fptportlet_INSTANCE_Qv8P&p_p_lifecycle=0&p_p_state=normal&p_p_mode=view&p_p_col_id=column-1&p_p_col_count=1&_InformationPublished_WAR_fptportlet_INSTANCE_Qv8P_javax.portlet.action=doView&_InformationPublished_WAR_fptportlet_INSTANCE_Qv8P_delta=20&_InformationPublished_WAR_fptportlet_INSTANCE_Qv8P_keywords=&_InformationPublished_WAR_fptportlet_INSTANCE_Qv8P_advancedSearch=false&_InformationPublished_WAR_fptportlet_INSTANCE_Qv8P_andOperator=true&_InformationPublished_WAR_fptportlet_INSTANCE_Qv8P_symbol=&_InformationPublished_WAR_fptportlet_INSTANCE_Qv8P_companyName=&_InformationPublished_WAR_fptportlet_INSTANCE_Qv8P_title=&_InformationPublished_WAR_fptportlet_INSTANCE_Qv8P_fromDate=&_InformationPublished_WAR_fptportlet_INSTANCE_Qv8P_toDate=&_InformationPublished_WAR_fptportlet_INSTANCE_Qv8P_ncId=0&_InformationPublished_WAR_fptportlet_INSTANCE_Qv8P_rpttype=&cur=".$id);
        $i=0;
        foreach($data->find('tr[class="results-row"]') as $tr){
            $link = '';
            if($tr->find('a')) {
                if($tr->find('td', 0)->find('a',0)){
                    $link = $tr->find('td', 0)->find('a',0)->href;
                    $link = html_entity_decode($link,null,'UTF-8');
                }
                // if cannot get link
                if (!$link) continue;

                $news = TableRegistry::get('News')->newEntity();
                $news->title_vie = $news->title_eng = $news->title_jpn = $tr->find('td', 0)->plaintext.': '.$tr->find('td', 1)->plaintext;
                $created = substr(trim($tr->find('td', 2)->plaintext), 0, 10);
                $news->created = str_replace('/','',substr($created, 6, 9).'-'.substr($created, 2, 3).'-'.substr($created, 0, 2));
                // convert to datetime format
                $news->content_vie = $news->content_eng = $news->content_jpn = $this->News->getContentSsc($link);
                $news->category_id = 17;
                $news->active = 1;
                $news->featured = 0;
                if($tr->find('td', 3)){
                    $news->file = $tr->find('td', 3)->find('a',0)->href;
                }

                $newsExisted = TableRegistry::get('News')->find()->where([
                    'title_eng' => $news->title_eng
                ]);

                if($newsExisted->toArray()){
                    $i++;
                    continue;
                }
                debug($i);
                TableRegistry::get('News')->save($news);
            }
        }
    }
}