<?php

namespace MakvilleAcl\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\ORM\Table;
use Cake\Datasource\ConnectionManager;
use Cake\Event\Event;
use Cake\ORM\Entity;

/**
 * Rentable behavior
 */
class RentableBehavior extends Behavior {

    public $accountConfig = [
        'className' => 'Cake\Database\Connection',
        'driver' => 'Cake\Database\Driver\Mysql',
        'persistent' => false,
        'host' => 'localhost',
        //'port' => 'nonstandard_port_number',
        'username' => 'user',
        'password' => 'user',
        'database' => 'tshop',
        'encoding' => 'utf8',
        'timezone' => 'UTC',
        'cacheMetadata' => true,
        'quoteIdentifiers' => false,
        'init' => ['SET GLOBAL innodb_stats_on_metadata = 0'],
    ];

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    private function generateDbName(Entity $entity) {
        return md5(date('Y-m-d H:i:s') . mt_rand(10000, 99999) . $entity->email);
    }

    public function beforeSave(Event $event, Entity $entity) {
        if ($entity->isNew()) {
            //generate a name for the database for the user and add to the entity to be saved
            $entity->db = $this->generateDbName($entity);
        }
    }

    public function afterSave(Event $event, Entity $entity) {
        if ($entity->isNew()) {
            //create the data store for the user now that the user has been saved
            $this->createDataStore($entity->db);
        }
    }

    public function generateConnection($db) {
        $config = $this->accountConfig;
        $config['database'] = $db;
        ConnectionManager::config($db, $config);
        //make this connection default
        ConnectionManager::alias($db, 'default');
    }

    public function createDataStore($db) {
        $sql = sprintf(file_get_contents(CONFIG . 'schema/data_store.sql'), $db, $db);
        $connection = ConnectionManager::get('default');
        $connection->query($sql);
    }

}
