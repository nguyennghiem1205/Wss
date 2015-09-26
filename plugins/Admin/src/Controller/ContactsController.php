<?php
namespace Admin\Controller;

use Admin\Controller\AppController;
use Cake\Utility\Security;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

class ContactsController extends AppController
{
    public function index(){
        $this->set('contacts', $this->Contacts->find());
    }

    public function add($id = null)
    {
        $contact = $this->Contacts->newEntity();

        if($id) { // if edit method
            $contact = $this->Contacts->get($id);
        }

        if ($this->request->is(['patch', 'post', 'put']))
        {
            $contact = $this->Contacts->patchEntity($contact, $this->request->data);

            if ($this->Contacts->save($contact))
            {
                $this->Flash->success(__('the contact has been saved'), ['plugin' => 'Admin']);
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error(__('the contact could not be saved'), ['plugin' => 'Admin']);
            }
        }

        $this->set(compact('contact'));
        $this->set('_serialize', ['contact']);
    }

    public function view($id = null)
    {
        $contact = $this->Contacts->get($id);
        $this->set(compact('contact'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contact = $this->Contacts->get($id);
        if ($this->Contacts->delete($contact)) {
            $this->Flash->success(__('the contacts has been deleted'), ['plugin' => 'Admin']);
        } else {
            $this->Flash->error(__('the contacts could not be deleted'), ['plugin' => 'Admin']);
        }
        return $this->redirect(['action' => 'index']);
    }
}
