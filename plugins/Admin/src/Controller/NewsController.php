<?php
namespace Admin\Controller;

use Admin\Controller\AppController;
use Cake\Utility\Security;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Cake\ORM\Table;

/**
 * @property bool|object Categories
 */
class NewsController extends AppController
{
    public function index(){
        $this->loadModel('News');
        $news = $this->News->find()->contain(['Categories'])->order('News.id', 'ASC');
        $this->set(compact('news'));
    }

    public function add($id = null)
    {
        $news = $this->News->newEntity();
        if($id) { // if edit method
            $news = $this->News->get($id);
        }

        if ($this->request->is(['patch', 'post', 'put']))
        {

            $news = $this->Core->patchEntity($news, $this->request->data, 'News');
            $news->posted = date('Y-m-d H:i', strtotime($this->request->data['posted']));
            if($this->request->data['created']){
                $news->created = date('Y-m-d H:i', strtotime($this->request->data['created']));
            }

            if ($this->News->save($news))
            {
                $this->Flash->success(__('the news has been saved'), ['plugin' => 'Admin']);
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error(__('the news could not be saved'), ['plugin' => 'Admin']);
            }
        }


        $this->imageFields = $news->imageFields;


        $categories = TableRegistry::get('Categories');
        $list = $categories->find('treeList',[
            'keyPath' => 'id',
            'valuePath' => 'title_eng',
            'spacer' => '_'
        ]);
        $this->set('list', $list);
        $this->set(compact('news'));
    }

    public function view($id = null)
    {
        $news = $this->News->get($id);
        $this->set(compact('news'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $row = $this->News->get($id);
        if ($this->News->delete($row)) {
            $this->Flash->success(__('the news has been deleted'), ['plugin' => 'Admin']);
        } else {
            $this->Flash->error(__('the news could not be deleted'), ['plugin' => 'Admin']);
        }
        return $this->redirect(['action' => 'index']);
    }
}
