<?php
namespace App\Model\Table;

use App\Model\Entity\News;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * News Model
 *
 */
class NewsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->table('news');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Categories');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');
        $validator
            ->requirePresence('title_eng', 'create')
            ->notEmpty('title_eng');
        $validator
            ->requirePresence('title_jpn', 'create')
            ->notEmpty('title_jpn');
        $validator
            ->requirePresence('title_vie', 'create')
            ->notEmpty('title_vie');
        $validator
            ->requirePresence('content_eng', 'create')
            ->notEmpty('content_eng');
        $validator
            ->requirePresence('content_jpn', 'create')
            ->notEmpty('content_jpn');
        $validator
            ->requirePresence('content_vie', 'create')
            ->notEmpty('content_vie');
        $validator
            ->requirePresence('description_vie', 'create')
            ->notEmpty('description_vie');
        $validator
            ->requirePresence('description_jpn', 'create')
            ->notEmpty('description_jpn');
        $validator
            ->requirePresence('description_eng', 'create')
            ->notEmpty('description_eng');
//        $validator
//            ->requirePresence('category', 'create')
//            ->notEmpty('category');
        $validator
            ->add('active', 'valid', ['rule' => 'numeric'])
            ->requirePresence('active', 'create')
            ->notEmpty('active');
        return $validator;
    }

    public function getContentSsc($link){
        $data = file_get_html($link);
        $table1 = $data->find('table', 0);
        $content = '<table>';
        $content .= '<tbody>';
        foreach($table1->find('tr') as $tr){
            if($tr->find('th', 0)){
                $content .= '<tr>';
                $content .= '<th>';
                $content .= $tr->find('th', 0)->plaintext;
                $content .= '</th>';
                $content .= '<td>';
                if($tr->find('td', 0)->find('a',0)){
                    $content .= '<a target="_blank" href="'.$tr->find('td', 0)->find('a',0)->href.'">'.$tr->find('td', 0)->plaintext.'</a>';
                }
                else{
                    $content .= $tr->find('td', 0)->plaintext;
                }
                $content .= '</td>';
                $content .= '</tr>';
            }
        }
        $content .= '</tbody>';
        $content .= '</table>';
        return $content;
    }

    function httpPost($url,$params)
    {
        $postData = '';
        //create name value pairs seperated by &
        foreach($params as $k => $v)
        {
            $postData .= $k . '='.$v.'&';
        }
        rtrim($postData, '&');

        $ch = curl_init();

        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, count($postData));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        $output=curl_exec($ch);

        curl_close($ch);
        return $output;
    }

    function saveFileFromUrl($oldUrl, $path, $fileName) {
        $url = str_replace(' ', '%20', $oldUrl);
        if (!is_dir(WWW_ROOT.'upload'.DS.$path)) {
            @mkdir(WWW_ROOT.'upload'.DS.$path);
        }
        $file = @file_get_contents($url);
        if (trim($file)) {
            if (@file_put_contents(WWW_ROOT.'upload'.DS.$path.DS.$fileName, $file)) {
                @chmod(WWW_ROOT.'upload'.DS.$path.DS.$fileName, 0777);
                return $fileName;
            };
        }
        return null;
    }

}
