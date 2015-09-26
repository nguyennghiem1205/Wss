<?php
namespace Admin\Controller;

use Admin\Controller\AppController;
use Cake\Utility\Security;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \Admin\Model\Table\CategoriesTable $Categories
 * @property bool layout
 * @property bool|object CurUser
 */
class CeoInfoController extends AppController
{
    public function index(){
        $this->set('ceoInfo', $this->CeoInfo->find()->order(['type' => 'DESC']));
        $this->set('_serialize', ['ceoInfo']);
    }

    public function add($id = null)
    {
        $ceoInfo = $this->CeoInfo->newEntity();

        if($id) { // if edit method
            $ceoInfo = $this->CeoInfo->get($id);
        }

        if ($this->request->is(['patch', 'post', 'put']))
        {
            $ceoInfo = $this->Core->patchEntity($ceoInfo, $this->request->data,'CeoInfo');
            //debug($this->request->data());die;
            if ($this->CeoInfo->save($ceoInfo))
            {
                $this->Flash->success(__('the CEO-Info has been saved'), ['plugin' => 'Admin']);
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error(__('the CEO-Info could not be saved'), ['plugin' => 'Admin']);
            }
        }
        $this->imageFields = $ceoInfo->imageFields;
//
        $this->set(compact('ceoInfo'));
        $this->set('_serialize', ['ceoInfo']);
    }
    public function view($id = null)
    {
        $ceoInfo = $this->CeoInfo->get($id);
        $this->set(compact('ceoInfo'));
        $this->set('_serialize', ['ceoInfo']);
    }
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $category = $this->CeoInfo->get($id);
        if ($this->CeoInfo->delete($category)) {
            $this->Flash->success(__('the CEO-Info has been deleted'), ['plugin' => 'Admin']);
        } else {
            $this->Flash->error(__('the CEO-Info could not be deleted'), ['plugin' => 'Admin']);
        }
        return $this->redirect(['action' => 'index']);
    }
}
