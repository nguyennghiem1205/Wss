<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Event\Event;

/**
 * Error Controller
 *
 * @property \App\Model\Table\ErrorTable $Error
 */
class ErrorController extends AppController
{
    /**
     * Called before the controller action. You can use this method to configure and customize components
     * or perform logic that needs to happen before each controller action.
     *
     * @param Event $event An Event instance
     * @return void
     * @link http://book.cakephp.org/3.0/en/controllers.html#request-life-cycle-callbacks
     */
    public function beforeFilter(Event $event)
    {
        if (!Configure::read('debug')) {
            $this->redirect(['controller' => 'Pages', 'action' => 'index']);
        }
        parent::beforeFilter($event); // TODO: Change the autogenerated stub
    }

    /**
     * Called after the controller action is run and rendered.
     *
     * @param Event $event An Event instance
     * @return void
     * @link http://book.cakephp.org/3.0/en/controllers.html#request-life-cycle-callbacks
     */
    public function afterFilter(Event $event)
    {
        parent::afterFilter($event); // TODO: Change the autogenerated stub
    }


}
