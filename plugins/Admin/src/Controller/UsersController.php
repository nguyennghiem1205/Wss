<?php
namespace Admin\Controller;

use Admin\Controller\AppController;
use Cake\Utility\Security;
use Cake\Validation\Validator;

/**
 * Users Controller
 *
 * @property \Admin\Model\Table\UsersTable $Users
 * @property bool layout
 * @property bool|object CurUser
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('users', $this->Users->find());
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @param null $id
     * @return \Cake\Network\Response|void
     */
    public function add($id = null)
    {
        $user = $this->Users->newEntity()->accessible('email', true)->accessible('group', true)->accessible('status', true);

        if($id) { // if edit method
            $user = $this->Users->get($id)->accessible('group', true)->accessible('status', true);
            
            //debug($this->request->data);
        }
        if ($this->request->is(['patch', 'post', 'put'])) 
        {               
            $user = $this->Core->patchEntity($user, $this->request->data);

            if ($this->Users->save($user))
            {                                
                $this->Flash->success(__('the user has been saved'), ['plugin' => 'Admin']);
                return $this->redirect(['action' => 'index']);
            } 
            else 
                {
                $this->Flash->error(__('the user could not be saved'), ['plugin' => 'Admin']);
            }
        }

        $this->imageFields = $user->imageFields;
        $this->buildHasMany($user,'menus',['container'=>'#hasmany-container','add'=>'.btn_add','delete'=>'.btn_delete']);
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('the user has been deleted'), ['plugin' => 'Admin']);
        } else {
            $this->Flash->error(__('the user could not be deleted'), ['plugin' => 'Admin']);
        }
        return $this->redirect(['action' => 'index']);
    }

    public function logout()
    {
        $this->request->session()->destroy();
        $this->redirect(['plugin' => null, 'controller'=>'users','action'=>'login']);
    }

    /**
     * profile of the current user login
     *
     * @return \Cake\Network\Response|void
     */
    public function profile()
    {
        $user = $this->Users->get($this->CurUser->id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Core->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('the user has been saved'), ['plugin' => 'Admin']);
                return $this->redirect(['action' => 'profile']);
            } else {
                $this->Flash->error(__('the user could not be saved'), ['plugin' => 'Admin']);
            }
        }

        $this->imageFields = $user->imageFields;
        $this->set(compact('user'));
    }

    /**
     * Update the password
     *
     * @return \Cake\Network\Response|void
     */
    public function change_password()
    {
        $user = $this->Users->get($this->CurUser->id);

        if($this->request->is(['patch', 'post', 'put'])){
            $oldPass = $this->request->data['old_password'];
            $oldPassHash = Security::hash($oldPass, 'sha1', true);

            if($oldPass && $oldPassHash != $user->password) {
                $this->Flash->error(__('the current password incorrect'));
            } else {
                $user->password = $this->request->data['new_password'];
                $user = $this->Users->patchEntity($user, $this->request->data);

                if ($this->Users->save($user)) {
                    $this->Flash->success(__('the password has been changed'), ['plugin' => 'Admin']);
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('the password could not be changed'), ['plugin' => 'Admin']);
                }
            }
        }

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function set_theme()
    {
        $this->layout = false;
        $this->autoRender = false;

        $theme = $this->request->query['theme'];
        $user = $this->Users->get($this->CurUser->id);
        $user->smart_admin_themes = $theme;
        $status = true;

        if (!$this->Users->save($user)) {
            $status = false;
        } else {
            $this->CurUser->smart_admin_themes = $theme;
            $this->request->session()->write('Core.Users', $user);
        }

        echo json_encode(['status' => $status]);
    }
}
