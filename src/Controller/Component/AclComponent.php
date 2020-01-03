<?php

namespace Acl\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;

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
        $table = TableRegistry::get('Acl.Users');
        return $table->find()->contain(['UserProfiles']);
    }
}
