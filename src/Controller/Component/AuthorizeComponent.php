<?php

namespace Acl\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Utility\Inflector;

use Cake\ORM\Locator\TableLocator;

/**
 * Authorize component
 */
class AuthorizeComponent extends Component {
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    
    public function __construct(ComponentRegistry $registry, array $config = array()) {
        parent::__construct($registry, $config);
    }
    
    public function getAction () {
        $action = [];
        $params = $this->_registry->getController()->request->params;
        $action['plugin'] = (is_null($params['plugin'])) ? 'app' : strtolower(Inflector::underscore($params['plugin']));
        $action['controller'] = strtolower(Inflector::underscore($params['controller']));
        $action['action'] = strtolower(Inflector::underscore($params['action']));
        return implode(".", $action);
    }
    
    public function isAuthorized ($user) {
        $locator = new TableLocator();
        $config = $locator->exists('MakvilleAcl.Users') ? [] : ['className' => 'MakvilleAcl\Model\Table\UsersTable'];
        $usersTable = $locator->get('MakvilleAcl.Users', $config);
        $userId = $user['id'];
        $action = $this->getAction();
        return $usersTable->isAuthorized($userId, $action);
    }
}
