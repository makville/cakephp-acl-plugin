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

    public function getUsers() {
        $locator = new TableLocator();
        $config = $locator->exists('MakvilleAcl.Users') ? [] : ['className' => 'MakvilleAcl\Model\Table\UsersTable'];
        $table = $locator->get('MakvilleAcl.Users', $config);
        return $table->find()->contain(['UserProfiles']);
    }
}
