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
        $this->createCategories();
        $this->crawlerSSC();
        $this->crawlerHSX();
        $this->crawlerHNX();

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

    public function createCategories(){
        $category = TableRegistry::get('Categories')->newEntity();
        $category->title_vie = $category->title_eng= $category->title_jpn = 'Tin tức SSC';
        $category->description_vie = $category->description_jpn = $category->description_eng = 'Thông tin công bố từ SSC';
        $category->active = 1;
        $category->id = 10001;
        $category->home = 0;
        $category->service = 0;
        TableRegistry::get('Categories')->save($category);

        $category = TableRegistry::get('Categories')->newEntity();
        $category->title_vie = $category->title_eng= $category->title_jpn = 'Tin tức HSX';
        $category->description_vie = $category->description_jpn = $category->description_eng = 'Thông tin công bố từ HSX';
        $category->id = 10002;
        $category->active = 1;
        $category->home = 0;
        $category->service = 0;
        TableRegistry::get('Categories')->save($category);

        $category = TableRegistry::get('Categories')->newEntity();
        $category->title_vie = $category->title_eng= $category->title_jpn = 'Tin tức HNX';
        $category->description_vie = $category->description_jpn = $category->description_eng = 'Thông tin công bố từ HNX';
        $category->id = 10003;
        $category->active = 1;
        $category->home = 0;
        $category->service = 0;
        TableRegistry::get('Categories')->save($category);
    }

    public function crawlerSSC(){
        $data = file_get_html("http://congbothongtin.ssc.gov.vn/web/guest/3?p_p_id=InformationPublished_WAR_fptportlet_INSTANCE_Qv8P&p_p_lifecycle=0&p_p_state=normal&p_p_mode=view&p_p_col_id=column-1&p_p_col_count=1&_InformationPublished_WAR_fptportlet_INSTANCE_Qv8P_javax.portlet.action=doView&_InformationPublished_WAR_fptportlet_INSTANCE_Qv8P_delta=20&_InformationPublished_WAR_fptportlet_INSTANCE_Qv8P_keywords=&_InformationPublished_WAR_fptportlet_INSTANCE_Qv8P_advancedSearch=false&_InformationPublished_WAR_fptportlet_INSTANCE_Qv8P_andOperator=true&_InformationPublished_WAR_fptportlet_INSTANCE_Qv8P_symbol=&_InformationPublished_WAR_fptportlet_INSTANCE_Qv8P_companyName=&_InformationPublished_WAR_fptportlet_INSTANCE_Qv8P_title=&_InformationPublished_WAR_fptportlet_INSTANCE_Qv8P_fromDate=&_InformationPublished_WAR_fptportlet_INSTANCE_Qv8P_toDate=&_InformationPublished_WAR_fptportlet_INSTANCE_Qv8P_ncId=0&_InformationPublished_WAR_fptportlet_INSTANCE_Qv8P_rpttype=&cur=1");
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

                $newsExisted = TableRegistry::get('News')->find()->where([
                    'title_eng' => $news->title_eng
                ]);

                if($newsExisted->toArray()){
                    continue;
                }

                $created = substr(trim($tr->find('td', 2)->plaintext), 0, 10);
                $created =  $created = str_replace('/', '-', $created);
                $created = date("Y-m-d H:i", strtotime($created));
                $news->created = $news->modified = $news->posted = $created;
                $news->content_vie = $news->content_eng = $news->content_jpn = $this->News->getContentSsc($link);
                $news->category_id = 10001;
                $news->active = 1;
                $news->featured = 0;
                if($tr->find('td', 3)){
                    $news->file = $tr->find('td', 3)->find('a',0)->href;
                }

                TableRegistry::get('News')->save($news);
            }
        }
    }

    public function crawlerHSX(){
        $url = "http://www1.hsx.vn/Modules/CMS/Web/ArticleInCategory/dca0933e-a578-4eaf-8b29-beb4575052c5?exclude=00000000-0000-0000-0000-000000000000&lim=True&pageFieldName1=FromDate&pageFieldValue1=26.09.2013&pageFieldOperator1=eq&pageFieldName2=ToDate&pageFieldValue2=26.09.2015&pageFieldOperator2=eq&pageFieldName3=TokenCode&pageFieldValue3=&pageFieldOperator3=eq&pageFieldName4=CategoryId&pageFieldValue4=dca0933e-a578-4eaf-8b29-beb4575052c5&pageFieldOperator4=eq&pageCriteriaLength=4&_search=false&nd=1443261342478&rows=30&page=1&sidx=id&sord=desc";
        $data = json_decode(file_get_contents($url));
        $data = $data->rows;
        foreach($data as $item) {
            $news = TableRegistry::get('News')->newEntity();

            $link = "http://www1.hsx.vn/Modules/Cms/Web/LoadArticle?id=" . $item->cell[0];
            preg_match('/(<span.*>)(.*)(<)/', $item->cell[2], $matches);
            $news->title_eng = $news->title_vie = $news->title_jpn = $matches[2];

            $newsExisted = TableRegistry::get('News')->find()->where([
                'title_eng' => $news->title_eng
            ]);
            if ($newsExisted->toArray()) {
                continue;
            }

            $created = $item->cell[1];
            $created = str_replace('CH', 'PM', $created);
            $created = str_replace('SA', 'AM', $created);
            $created = str_replace('/', '-', $created);
            $news->created = $news->modified = $news->posted = date("Y-m-d H:i", strtotime($created));

            $data = file_get_html($link);
            if ($data->find('a', 0)) {
                $file_href = 'http://www1.hsx.vn' . $data->find('a', 0)->href;
                $file_text = $data->find('a', 0)->plaintext;
                $this->News->saveFileFromUrl($file_href, 'News', $file_text);
                $news->file = $file_text;
            }

            $content = $data->find('div[class="desc unreset"]' , 0)->plaintext;
            $content = $content.'<br>'.'Tài liệu đính kèm'.': '.'<a href ="'.$file_href.'">'.$file_text .'</a>';
            $content = html_entity_decode($content,null,'UTF-8');
            $news->content_vie = $news->content_jpn = $news->content_eng = $content;
            $news->description_vie = $news->description_jpn = $news->description_eng = $content;
            $news->category_id = 10002;
            $news->active = 1;
            $news->featured = 0;

            TableRegistry::get('News')->save($news);
        };
    }

    public function crawlerHNX(){

        $params = array(
            'iDisplayStart' => 0,
            'iDisplayLength' => 50
        );

        $data = json_decode($this->News->httpPost("http://hnx.vn/web/guest/tin-niem-yet;jsessionid=hRhDWLBKXLNghg156v7Fx0pS2NgNSx2dGqCxmfKCJJjY2cGwL2B1!1280351445!1443365258508?p_p_id=ThongTinCongBo_WAR_ThongTinCongBoportlet_INSTANCE_aO8s&p_p_lifecycle=2&p_p_state=normal&p_p_mode=view&p_p_cacheability=cacheLevelPage&p_p_col_id=column-3&p_p_col_count=1&_ThongTinCongBo_WAR_ThongTinCongBoportlet_INSTANCE_aO8s_anchor=newsAction",$params));
        $data = $data->aaData;
        foreach($data as $item){
            $news = TableRegistry::get('News')->newEntity();
            $created = $item[1];
            $created = str_replace('/', '-', $created);
            $news->created = $news->modified = $news->posted = date("Y-m-d H:i", strtotime($created));

            $get_content = file_get_html('http://hnx.vn/web/guest/tin-niem-yet;jsessionid=rVnGWLQBkSyFfV24xrY2Dr9XfvCPxKJKkpGcQYz6nV4ZXv842DhT!1280351445!1443369089074?p_auth=CEtgQ6bS&p_p_id=ThongTinCongBo_WAR_ThongTinCongBoportlet_INSTANCE_aO8s&p_p_lifecycle=1&p_p_state=exclusive&p_p_mode=view&p_p_col_id=column-3&p_p_col_count=1&_ThongTinCongBo_WAR_ThongTinCongBoportlet_INSTANCE_aO8s_anchor=viewAction&_ThongTinCongBo_WAR_ThongTinCongBoportlet_INSTANCE_aO8s_cmd=viewContent&_ThongTinCongBo_WAR_ThongTinCongBoportlet_INSTANCE_aO8s_news_id='.$item[9]);

            $title = $item[5].' ('.$item[2].'): '.$item[6];
            $news->title_eng = $news->title_jpn = $news->title_vie = $title;

            $newsExisted = TableRegistry::get('News')->find()->where([
                'title_eng' => $news->title_eng
            ]);
            if($newsExisted->toArray()){
                continue;
            }

            $content = ($get_content->find('table', 2)->find('div', 0)->innertext);

            $file = '';
            if($get_content->find('a', 0)) {
                $file = '<br>Tài liệu đính kèm: '.'<a href="'.$get_content->find('a', 0)->href.'">'.$get_content->find('a', 0)->plaintext.'</a>';
                $this->News->saveFileFromUrl($get_content->find('a', 0)->href, 'News', $get_content->find('a', 0)->plaintext);
                $news->file = $get_content->find('a', 0)->plaintext;
            }

            if($file != ''){
                $content = $content.$file;
            }

            $news->content_vie = $news->content_jpn = $news->content_eng = $content;
            $news->description_vie = $news->description_jpn = $news->description_eng = $content;
            $news->category_id = 10003;
            $news->active = 1;
            $news->featured = 0;

            TableRegistry::get('News')->save($news);
        }
    }




}