<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\View\View;
use Core;


/**
 * News Controller
 *
 * @property \App\Model\Table\NewsTable $News
 */
class NewsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadComponent('Core');
        $this->loadModel('FrontendMenus');
        $this->loadModel('Slides');
        $this->loadModel('Admin.MailSubs');
        $mailSub=$this->MailSubs->newEntity();
        $lv0=$frontend_menus = $this->FrontendMenus->find('all', ['conditions' => ['active' => 1,'level'=>0],'order'=>['position'=>'ASC']])->toArray();
        $lv1=$frontend_menus = $this->FrontendMenus->find('all', ['conditions' => ['active' => 1,'level'=>1],'order'=>['position'=>'ASC']])->toArray();
        $lv2=$frontend_menus = $this->FrontendMenus->find('all', ['conditions' => ['active' => 1,'level'=>2],'order'=>['position'=>'ASC']])->toArray();
        $slides=$this->Slides->find('all',['conditions'=>['active'=>1]]);
        $frontend_menus = $this->FrontendMenus->find('all', ['conditions' => ['active' => 1]]);
        $this->set(compact('lv0','lv1','lv2','slides','frontend_menus','mailSub'));
    }

    public $paginate = [
        'limit' => 10,
    ];

    public function index(){

    }

    public function category($id = null)
    {
        if(!TableRegistry::get('Categories')->find()->where(['active' => 1,'id' => $id])->first()){
            return $this->redirect(['controller' => 'Pages', 'action' => 'index']);
        }
        $title = TableRegistry::get('Categories')->find()->select(['title_eng','title_jpn','title_vie'])->where(['active' => 1, 'id' => $id])->first();
        $boms = TableRegistry::get('CeoInfo')->find()->where(['active' => 1, 'type' => 3])->order(['id' => 'DESC'])->limit(2);
        $query = TableRegistry::get('News')->find()
                    ->where(['active' => 1,'category_id' => $id, 'posted <=' => date("Y-m-d H:i")])
                    ->order(['created' => 'DESC']);
        $news = $this->paginate($query);
        $at_leftmenu=null;
        $leftMenu=$this->Core->getLeftMenu(0,$id,$at_leftmenu);
        $this->set(compact('leftMenu'));
        $this->set('at_leftmenu',$at_leftmenu[0]);
        $this->set(compact('news','title','boms'));
        $this->set('settings',TableRegistry::get('Settings')->find());

    }

    public function view($id = null){
        $news = $this->News->find()->contain(['Categories'])->where(['News.id' => $id, 'News.active' => 1, 'News.posted <=' => date("Y-m-d H:i")])->first();
        $boms = TableRegistry::get('CeoInfo')->find()->where(['active' => 1, 'type' => 3])->order(['id' => 'DESC'])->limit(2);

        if(!$news){
            return $this->redirect(['controller' => 'Pages', 'action' => 'index']);
        }
        $title = TableRegistry::get('Categories')->find()->select(['title_eng','title_jpn','title_vie'])->where(['active' => 1, 'id' =>  $news->category['id']])->first();
        $recentlist = $this->News->find()->where(['active' => 1, 'category_id' => $news->category['id'], 'id !=' => $id, 'posted <=' => date("Y-m-d H:i")])->order(['created' => 'ASC'])->limit(5);
        $at_leftmenu=null;
        $leftMenu=$this->Core->getLeftMenu(1,$id,$at_leftmenu);
        $this->set(compact('leftMenu'));
        $this->set('at_leftmenu',$at_leftmenu[0]);
        $this->set(compact('news', 'recentlist', 'title','boms'));
        $this->set('settings',TableRegistry::get('Settings')->find());
    }

    public function ajaxDeleleImage(){
        $this->autoRender = false;
        $data = $this->request->data();
        $project = $this->News->find()->where(['id' => $data['cid']])->first();
        $project->image = '';

        $status = false;
        if ($this->News->save($project)) {
            $status = true;
        }

        echo json_encode([
            'status' => $status
        ]);
    }

    public function ajaxDeleleFile(){
        $this->autoRender = false;
        $data = $this->request->data();
        $project = $this->News->find()->where(['id' => $data['cid']])->first();
        $project->file = '';

        $status = false;
        if ($this->News->save($project)) {
            $status = true;
        }

        echo json_encode([
            'status' => $status
        ]);
    }

    public function ajaxDeleleCategoryImage(){
        $this->autoRender = false;
        $data = $this->request->data();
        $project = TableRegistry::get('Categories')->find()->where(['id' => $data['cid']])->first();
        $project->image = '';

        $status = false;
        if (TableRegistry::get('Categories')->save($project)) {
            $status = true;
        }

        echo json_encode([
            'status' => $status
        ]);
    }
}
