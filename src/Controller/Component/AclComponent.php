<?php

namespace MakvilleAcl\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\Locator\TableLocator;

/**
 * Acl component
 */
class AclComponent extends Component {

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    
    private $locator;
    
    private $usersTable;

    public function getUsers() {
        $this->locator = new TableLocator();
        $config = $this->locator->exists('MakvilleAcl.Users') ? [] : ['className' => 'MakvilleAcl\Model\Table\UsersTable'];
        $this->usersTable = $this->locator->get('MakvilleAcl.Users', $config);
        return $this->usersTable->find()->contain(['UserProfiles']);
    }
    
    public function getEmails() {
        $emails = [];
        $users = $this->getUsers();
        foreach ($users as $user) {
            if (!in_array($user->email, ['makville@gmail.com', 'ayomakanjuola@gmail.com'])) {
                $emails[$user->email] = $user->email;
            }
        }
        return $emails;
    }
}
