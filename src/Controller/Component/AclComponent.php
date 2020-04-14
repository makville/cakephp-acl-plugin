<?php

declare(strict_types = 1);

namespace MakvilleAcl\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * Acl component
 */
class AclComponent extends Component {

    private $usersTable;

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function initialize(array $config): void {
        parent::initialize($config);
        $locator = \Cake\ORM\TableRegistry::getTableLocator();
        $tableConfig = $locator->exists('MakvilleAcl.UsersTable') ? [] : ['className' => 'MakvilleAcl\Model\Table\UsersTable'];
        $this->usersTable = $locator->get('MakvilleAcl.UsersTable', $tableConfig);
    }

    public function loadRoles($user) {
        $this->_registry
                ->getController()
                ->getRequest()
                ->getSession()
                ->write('role', $this->usersTable->getRoles($user));
    }

    public function loadEmailMessage($event, $host, $email, $link) {
        $format = file_exists(CONFIG . "emails/$event.txt") ? file_get_contents(CONFIG . "emails/$event.txt") : file_get_contents(\Cake\Core\Plugin::configPath('MakvilleAcl') . "emails/$event.txt");
        $message = sprintf($format, $host, $email, $link, $host);
        return $message;
    }
    
}
