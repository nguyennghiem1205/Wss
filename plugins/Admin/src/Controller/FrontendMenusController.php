<?php
namespace Admin\Controller;

use Admin\Controller\AppController;
use Cake\Utility\Security;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;


/**
 * Users Controller
 *
 * @property \Admin\Model\Table\FrontendMenuTable $FrontendMenus
 * @property bool layout
 * @property bool|object CurUser
 */
class FrontendMenusController extends AppController
{
    public function index(){
        $mns = TableRegistry::get('FrontendMenus');
        $list[0] = '_ROOT_';
        $list += $mns->find('treeList',[
            'keyPath' => 'id',
            'valuePath' => 'name_eng',
            'spacer' => '--| '
        ])->toArray();
//        debug($children);die;
        $this->set('list', $list);
        $this->set('frontend_menu', $this->FrontendMenus->find()->order('position', 'ASC'));
        $this->set('_serialize', ['frontend_menu']);
    }

    public function add($id = null)
    {
        $frontend_menu = $this->FrontendMenus->newEntity();

        if($id) { // if edit method
            $frontend_menu = $this->FrontendMenus->get($id);
        }

        if ($this->request->is(['patch', 'post', 'put']))
        {
            $frontend_menu = $this->FrontendMenus->patchEntity($frontend_menu, $this->request->data);
            if ($this->FrontendMenus->save($frontend_menu))
            {
                $this->Flash->success(__('the menu has been saved'), ['plugin' => 'Admin']);
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error(__('the menu could not be saved'), ['plugin' => 'Admin']);
            }
        }
        //list mn
        $mn = TableRegistry::get('FrontendMenus');
        $list_mn = $mn->find('treeList',[
            'keyPath' => 'id',
            'valuePath' => 'name_eng'
        ]);
        //list site
        $sites = TableRegistry::get('Sites');
        $list_sites=$sites->find('list',['valueField'=>'title_'.__('lang'),'keyField'=>'id','conditions'=>['active'=>1]]);
        //list categories
        $categories = TableRegistry::get('Categories');
        $list_cat = $categories->find('treeList',[
            'keyPath' => 'id',
            'valuePath' => 'title_eng'
        ]);

        $others=['contact'=>'Contact','recruitment'=>'Recruitment'];
        $this->set('list_mn', $list_mn);
        $this->set('sites', $list_sites);
        $this->set('list_cat', $list_cat);
        $this->set(compact('frontend_menu','others'));
        $this->set('_serialize', ['frontend_menu']);
    }
    public function view($id = null)
    {
        $category = $this->Categories->get($id);
        $this->set(compact('category'));
        $this->set('_serialize', ['category']);
    }
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $row = $this->FrontendMenus->get($id);
        if ($this->FrontendMenus->delete($row)) {
            $this->Flash->success(__('the menu has been deleted'), ['plugin' => 'Admin']);
        } else {
            $this->Flash->error(__('the menu could not be deleted'), ['plugin' => 'Admin']);
        }
        return $this->redirect(['action' => 'index']);
    }
    function ajax_update_position(){
        if($this->request->is('ajax')){
            $this->autoRender = false;
            $this->layout = false;
            $postData = $this->request->data;
            $idData = json_decode($postData['pid']);
            unset($idData[0]);
            foreach($idData as $key => $val){
                $row = $this->FrontendMenus->get($val);
                $row->position = $key;
                $this->FrontendMenus->save($row);
            }
        }
    }
}
