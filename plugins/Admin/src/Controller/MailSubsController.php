<?php
namespace Admin\Controller;

use Admin\Controller\AppController;

/**
 * MailSubs Controller
 *
 * @property \Admin\Model\Table\MailSubsTable $MailSubs
 */
class MailSubsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('mailSubs', $this->paginate($this->MailSubs));
        $this->set('_serialize', ['mailSubs']);
    }
    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($id=null)
    {
        $this->autoRender = false;
        $mailSub = $this->MailSubs->newEntity();
        if ($this->request->is('post')) {
            $mailSub = $this->MailSubs->patchEntity($mailSub, $this->request->data);
            if ($this->MailSubs->save($mailSub)) {
                $this->Flash->success(__('Subscribe success!'));
                return $this->redirect('/');
            } else {
                $this->Flash->error(__('Subscribe unsuccessful. Please, try again.'));
            }
        }
        $this->set(compact('mailSub'));
        $this->set('_serialize', ['mailSub']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Mail Sub id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mailSub = $this->MailSubs->get($id);
        if ($this->MailSubs->delete($mailSub)) {
            $this->Flash->success(__('The mail sub has been deleted.'));
        } else {
            $this->Flash->error(__('The mail sub could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
