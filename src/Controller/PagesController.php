<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Database\Schema\Table;
use Cake\I18n\I18n;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @property null layout
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    public $helpers=['Menu'];
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Cookie', ['expiry' => '1 day']);
        $this->loadModel('Admin.MailSubs');
        $this->loadModel('Admin.Messages');
        $this->loadModel('FrontendMenus');
        $this->loadModel('Slides');
        $mailSub=$this->MailSubs->newEntity();
        $slides=$this->Slides->find('all',['conditions'=>['active'=>1]]);
        $lv0=$frontend_menus = $this->FrontendMenus->find('all', ['conditions' => ['active' => 1,'level'=>0],'order'=>['position'=>'ASC']])->toArray();
        $lv1=$frontend_menus = $this->FrontendMenus->find('all', ['conditions' => ['active' => 1,'level'=>1],'order'=>['position'=>'ASC']])->toArray();
        $lv2=$frontend_menus = $this->FrontendMenus->find('all', ['conditions' => ['active' => 1,'level'=>2],'order'=>['position'=>'ASC']])->toArray();
        $boms = TableRegistry::get('CeoInfo')->find()->where(['active' => 1, 'type' => 3])->order(['id' => 'DESC'])->limit(2);
        $this->set(compact('lv0','lv1','lv2','mailSub','slides','boms'));
    }

        public function index()
        {
            $this->loadModel('FrontendMenus');
            $this->loadModel('Slides');
            $slides=$this->Slides->find('all',['conditions'=>['active'=>1]]);
            $frontend_menus = $this->FrontendMenus->find('all', ['conditions' => ['active' => 1]]);
            $this->set(compact('frontend_menus'));
            $this->set(compact('slides'));

            $news = TableRegistry::get('News');
            $categories = TableRegistry::get('Categories');
            $topnews = $news->find()->where(['active' => 1, 'posted <=' => date("Y-m-d H:i")])->order(['created' => 'DESC'])->limit(10);
            $featured_news = $news->find()->where(['active' => 1, 'posted <=' => date("Y-m-d H:i"), 'featured' => 1])->order(['created' => 'DESC'])->limit(3);

            $category_news = $categories->find()->where(['active' => 1, 'home' => 1])->order(['id' => 'ASC'])->limit(2);
            $news_list1 = $news->find()->contain(['Categories'])->where(['News.active' => 1, 'News.posted <=' => date("Y-m-d H:i"), 'News.category_id' => $category_news->toArray()[0]['id']])->order(['News.created' => 'DESC'])->limit(5);
            $news_list2 = $news->find()->contain(['Categories'])->where(['News.active' => 1, 'News.posted <=' => date("Y-m-d H:i"), 'News.category_id' => $category_news->toArray()[1]['id']])->order(['News.created' => 'DESC'])->limit(5);

            $num_category_service = $categories->find()->where(['active' => 1, 'service' => 1])->order(['id' => 'ASC'])->count();
            $category_service = $categories->find()->where(['active' => 1, 'service' => 1])->order(['id' => 'ASC']);

            $service_list = array();
            for($k = 0; $k < $num_category_service; $k++){
                $news_list = $news->find()->contain(['Categories'])->where(['News.active' => 1, 'News.posted <=' => date("Y-m-d H:i"), 'News.category_id' => $category_service->toArray()[$k]['id']])->order(['News.created' => 'DESC'])->limit(5);
                array_push($service_list, $news_list);
            }

            $clients = TableRegistry::get('CeoInfo')->find()->where(['active' => 1, 'type' => 1])->order(['id' => 'DESC'])->limit(3);
            $partnerships = TableRegistry::get('CeoInfo')->find()->where(['active' => 1, 'type' => 2])->order(['id' => 'DESC'])->limit(6);
            $boms = TableRegistry::get('CeoInfo')->find()->where(['active' => 1, 'type' => 3])->order(['id' => 'DESC'])->limit(2);
            $this->set('settings',TableRegistry::get('Settings')->find());
            $this->set(compact('topnews','featured_news','news_list1','news_list2', 'service_list', 'clients', 'boms', 'partnerships'));
        }

    
    public function cake()
    {
        // This is default action of cake to check configuration
    }


    public function view($id=null){
        $site = TableRegistry::get('Sites')->find()->where(['id' => $id, 'active' => 1])->first();
        $boms = TableRegistry::get('CeoInfo')->find()->where(['active' => 1, 'type' => 3])->order(['id' => 'DESC'])->limit(2);
        if(!$site) {
            return $this->redirect(['controller' => 'Pages', 'action' => 'index']);
        }
        //left menu
        $at_leftmenu=null;
        $leftMenu=$this->Core->getLeftMenu(2,$id,$at_leftmenu);
//        debug($leftMenu);die;
        $this->set(compact('site','boms'));
        $this->set(compact('leftMenu'));
        $this->set('at_leftmenu',$at_leftmenu[0]);
        $this->set('settings',TableRegistry::get('Settings')->find());
    }

    public $paginate = [
        'limit' => 10,
    ];

    public function search(){
        $key=null;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $key = $this->request->data['key'];
        }
        if($key!=""){
            $query = TableRegistry::get('News')->find()
                ->where(['active' => 1,'title_'.__('lang').' LIKE' =>'%'. $key.'%', 'posted <=' => date("Y-m-d H:i")])
                ->orWhere(['active' => 1,'content_'.__('lang').' LIKE' =>'%'. $key.'%', 'posted <=' => date("Y-m-d H:i")])
                ->orWhere(['description_'.__('lang').' LIKE' =>'%'. $key.'%'])
                ->order(['created' => 'DESC']);
            $news = $this->paginate($query);
            $dem=count($news);
            $title = __('Có <span>{0}</span> kết quả với từ khóa "{1}"',$dem,$key);
            $this->set(compact('news','title'));
        }
        else return $this->redirect(['action' => 'index']);
        $this->set('settings',TableRegistry::get('Settings')->find());
    }

    public function recruitment($id = null){
        if($id){
            $news = TableRegistry::get('Recruits')->find()->where(['active' => 1, 'id' => $id])->first();
            if(!$news) {
                return $this->redirect(['controller' => 'Pages', 'action' => 'index']);
            }
        }
        else{
            $news = TableRegistry::get('Recruits')->find()->where(['active' => 1])->order(['created' => 'DESC'])->first();
        }

        $positions = TableRegistry::get('Recruits')->find()->where(['active' => 1, 'deadline >=' => date("Y-m-d H:i"), 'id !=' => $news['id']])->distinct('position')->order(['created' => 'DESC']);
        $recent_news = TableRegistry::get('Recruits')->find()->where(['active' => 1, 'deadline >=' => date("Y-m-d H:i"), 'id !=' => $news['id']])->order(['created' => 'DESC'])->limit(5);
        $this->set('settings',TableRegistry::get('Settings')->find());
        $boms = TableRegistry::get('CeoInfo')->find()->where(['active' => 1, 'type' => 3])->order(['id' => 'DESC'])->limit(2);
        $this->set(compact('news','recent_news','positions','boms'));
    }

    public function contact(){
        $contacts = TableRegistry::get('Contacts')->find()->where(['active' => 1]);
        $boms = TableRegistry::get('CeoInfo')->find()->where(['active' => 1, 'type' => 3])->order(['id' => 'DESC'])->limit(2);
        $message = $this->Messages->newEntity();
        if ($this->request->is('post')) {
            $message = $this->Messages->patchEntity($message, $this->request->data);
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('Gửi liên hệ thành công. Chúc tôi sẽ liên lạc lại trong thời gian sớm nhất!'));
                return $this->redirect(['action' => 'contact']);
            } else {
                $this->Flash->error(__('Không thể gửi liên hệ. Vui lòng thử lại!'));
            }
        }
        $this->set(compact('contacts', 'boms','msg','message'));
        $this->set('settings',TableRegistry::get('Settings')->find());
    }

    /**
     * change language
     * @param $lang
     */
    public function change_language($lang)
    {
        $this->request->session()->write('Config.language', $lang);
        I18n::locale($lang);
        $this->Cookie->write('language',$lang);
        Configure::load('constant', 'default', false);
        $this->redirect($this->referer());
    }

    public function mailSub()
    {
        $this->autoRender = false;
        $mailSub = $this->MailSubs->newEntity();
        if ($this->request->is('post')) {
            $mailSub = $this->MailSubs->patchEntity($mailSub, $this->request->data);
            if ($this->MailSubs->save($mailSub)) {
                $this->Flash->success(__('Subscribe success!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Subscribe unsuccessful. This email is already in use'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('mailSub'));
        $this->set('_serialize', ['mailSub']);
    }

    public function ajaxDeleleImage(){
        $this->autoRender = false;
        $data = $this->request->data();
        $project = TableRegistry::get('Recruits')->find()->where(['id' => $data['cid']])->first();
        $project->image = '';

        $status = false;
        if (TableRegistry::get('Recruits')->save($project)) {
            $status = true;
        }

        echo json_encode([
            'status' => $status
        ]);
    }

    public function ajaxDeleleFile(){
        $this->autoRender = false;
        $data = $this->request->data();
        $project = TableRegistry::get('Recruits')->find()->where(['id' => $data['cid']])->first();
        $project->file = '';

        $status = false;
        if (TableRegistry::get('Recruits')->save($project)) {
            $status = true;
        }

        echo json_encode([
            'status' => $status
        ]);
    }

    public function ajaxDeleleSiteImage(){
        $this->autoRender = false;
        $data = $this->request->data();
        $project = TableRegistry::get('Sites')->find()->where(['id' => $data['cid']])->first();
        $project->image = '';

        $status = false;
        if (TableRegistry::get('Sites')->save($project)) {
            $status = true;
        }

        echo json_encode([
            'status' => $status
        ]);
    }


}
