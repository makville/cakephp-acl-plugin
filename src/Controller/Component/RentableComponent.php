<?php

namespace Acl\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Rentable component
 */
class RentableComponent extends Component {

    public $components = ['Auth'];

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function startup(Event $event) {
        if ($this->Auth->user()) {
            //get the controller
            $controller = $event->subject();
            if ($controller->isRentable) {
                //which connection to use
                $userTable = TableRegistry::get('AclUsers', ['className' => 'Acl\Model\Table\AclUsersTable']);
                //get the user.
                $dbName = '';
                if ($this->request->session()->read('db_name') != '') {
                    $dbName = $this->request->session()->read('db_name');
                } else {
                    $dbName = $userTable->find()->where(['id' => $this->Auth->user('id')])->first()->db;
                    $this->request->session()->write('db_name', $dbName);
                }
                $userTable->generateConnection($dbName);
            }
        }
    }

}
