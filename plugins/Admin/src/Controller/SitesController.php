<?php
namespace Admin\Controller;

use Admin\Controller\AppController;
use Cake\Utility\Security;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 *
 * @property \Admin\Model\Table\PagesTable $Categories
 * @property bool layout
 * @property bool|object CurUser
 */
class SitesController extends AppController
{
    public function index(){
        $this->set('sites', $this->Sites->find());
    }

    public function add($id = null)
    {
        $site = $this->Sites->newEntity();

        if($id) { // if edit method
            $site = $this->Sites->get($id);
        }

        if ($this->request->is(['patch', 'post', 'put']))
        {
            $site = $this->Core->patchEntity($site, $this->request->data, 'Sites');

            if ($this->Sites->save($site))
            {
                $this->Flash->success(__('the site has been saved'), ['plugin' => 'Admin']);
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error(__('the site could not be saved'), ['plugin' => 'Admin']);
            }
        }
        $this->imageFields = $site->imageFields;

        $this->set(compact('site'));
        $this->set('_serialize', ['site']);
    }

    public function view($id = null)
    {
        $site = $this->Sites->get($id);
        $this->set(compact('site'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $row = $this->Sites->get($id);
        if ($this->Sites->delete($row)) {
            $this->Flash->success(__('the site has been deleted'), ['plugin' => 'Admin']);
        } else {
            $this->Flash->error(__('the site could not be deleted'), ['plugin' => 'Admin']);
        }
        return $this->redirect(['action' => 'index']);
    }

}
