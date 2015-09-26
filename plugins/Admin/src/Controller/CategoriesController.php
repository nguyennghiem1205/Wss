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
class CategoriesController extends AppController
{
    public function index(){
        $categories = TableRegistry::get('Categories');
        $list[0] = '_ROOT_';
        $list += $categories->find('treeList',[
            'keyPath' => 'id',
            'valuePath' => 'title_eng',
            'spacer' => '--| '
        ])->toArray();
        $this->set('list', $list);
        $this->set('categories', $this->Categories->find());
        $this->set('_serialize', ['categories']);

    }

    public function add($id = null)
    {
        $category = $this->Categories->newEntity();

        if($id) { // if edit method
            $category = $this->Categories->get($id);
        }

        if ($this->request->is(['patch', 'post', 'put']))
        {
            $category = $this->Core->patchEntity($category, $this->request->data);
            if ($this->Categories->save($category))
            {
                $this->Flash->success(__('the category has been saved'), ['plugin' => 'Admin']);
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error(__('the category could not be saved'), ['plugin' => 'Admin']);
            }
        }
        $this->imageFields = $category->imageFields;

        $categories = TableRegistry::get('Categories');
        $list = $categories->find('treeList',[
            'keyPath' => 'id',
            'valuePath' => 'title_eng',
            'spacer' => '--| '
        ]);
        $this->set('list', $list);
        $this->set(compact('category'));
        $this->set('_serialize', ['category']);
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
        $category = $this->Categories->get($id);
        if ($this->Categories->delete($category)) {
            $this->Flash->success(__('the categories has been deleted'), ['plugin' => 'Admin']);
        } else {
            $this->Flash->error(__('the categories could not be deleted'), ['plugin' => 'Admin']);
        }
        return $this->redirect(['action' => 'index']);
    }
}
