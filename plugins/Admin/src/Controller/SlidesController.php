<?php
namespace Admin\Controller;

use Admin\Controller\AppController;

/**
 * Slides Controller
 *
 * @property \Admin\Model\Table\SlidesTable $Slides
 */
class SlidesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('slides', $this->paginate($this->Slides));
        $this->set('_serialize', ['slides']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($id=null)
    {
        $slide = $this->Slides->newEntity();
        if($id) {
            $slide = $this->Slides->get($id);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $slide = $this->Core->patchEntity($slide, $this->request->data, 'Slides');
            if ($this->Slides->save($slide)) {
                $this->Flash->success(__('The slide has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The slide could not be saved. Please, try again.'));
            }
        }
        $this->imageFields = $slide->imageFields;
        $this->set(compact('slide'));
        $this->set('_serialize', ['slide']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Slide id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $slide = $this->Slides->get($id);
        if ($this->Slides->delete($slide)) {
            $this->Flash->success(__('The slide has been deleted.'));
        } else {
            $this->Flash->error(__('The slide could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
