<?php
namespace Admin\Controller;

use Admin\Controller\AppController;
use Cake\Utility\Security;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

class RecruitsController extends AppController
{
    public function index(){
        $this->set('recruits', $this->Recruits->find());
    }

    public function add($id = null)
    {

        $recruit = $this->Recruits->newEntity();

        if($id) { // if edit method
            $recruit = $this->Recruits->get($id);
        }

        if ($this->request->is(['patch', 'post', 'put']))
        {
            $recruit = $this->Core->patchEntity($recruit, $this->request->data, 'Recruits');
            $recruit->deadline = date('Y-m-d H:i', strtotime($this->request->data['deadline']));

            if ($this->Recruits->save($recruit))
            {
                $this->Flash->success(__('the recruitment news has been saved'), ['plugin' => 'Admin']);
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error(__('the recruitment news could not be saved'), ['plugin' => 'Admin']);
            }
        }
        $this->imageFields = $recruit->imageFields;

        $this->set(compact('recruit'));
        $this->set('_serialize', ['recruit']);
    }

    public function view($id = null)
    {
        $recruit = $this->Recruits->get($id);
        $this->set(compact('recruit'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $recruit = $this->Recruits->get($id);
        if ($this->Recruits->delete($recruit)) {
            $this->Flash->success(__('the news has been deleted'), ['plugin' => 'Admin']);
        } else {
            $this->Flash->error(__('the news could not be deleted'), ['plugin' => 'Admin']);
        }
        return $this->redirect(['action' => 'index']);
    }
}
