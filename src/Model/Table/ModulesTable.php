<?php

namespace MakvilleAcl\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Modules Model
 *
 * @property \Cake\ORM\Association\HasMany $ModuleActionGroups
 * @property \Cake\ORM\Association\HasMany $ModuleActions
 *
 * @method \Acl\Model\Entity\Module get($primaryKey, $options = [])
 * @method \Acl\Model\Entity\Module newEntity($data = null, array $options = [])
 * @method \Acl\Model\Entity\Module[] newEntities(array $data, array $options = [])
 * @method \Acl\Model\Entity\Module|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Acl\Model\Entity\Module patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Acl\Model\Entity\Module[] patchEntities($entities, array $data, array $options = [])
 * @method \Acl\Model\Entity\Module findOrCreate($search, callable $callback = null)
 */
class ModulesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void {
        parent::initialize($config);

        $this->setTable('modules');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('ModuleActionGroups', [
            'foreignKey' => 'module_id',
            'className' => 'Acl.ModuleActionGroups'
        ]);
        $this->hasMany('ModuleActions', [
            'foreignKey' => 'module_id',
            'className' => 'Acl.ModuleActions'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator {
        $validator
                ->integer('id')
                ->allowEmpty('id', 'create');

        $validator
                ->allowEmpty('name');

        $validator
                ->allowEmpty('description');

        $validator
                ->allowEmpty('is_system');

        $validator
                ->allowEmpty('is_public');

        return $validator;
    }

    public function isUnique($name, $isSystem, $signature) {
        if ($this->find()->where(['name' => $name])->count() == 0) {
            return true;
        }
        //confirm system status
        $moduleEntity = $this->find()->where(['name' => $name])->first();
        $moduleEntity->signature = $signature;
        if ($moduleEntity->is_system != $isSystem) {
            $moduleEntity->is_system = $isSystem;
        }
        $this->save($moduleEntity);
        return false;
    }

    public function getModuleActionStructure() {
        return $this->find()->contain(['ModuleActionGroups' => ['ModuleActions']]);
    }

    public function isSystem($path) {
        $dir = new DirectoryIterator($path);
        foreach ($dir as $file) {
            if ($file->getFilename() == 'system') {
                return true;
            }
        }
        return false;
    }

    public function isPublic($path) {
        $dir = new DirectoryIterator($path);
        foreach ($dir as $file) {
            if ($file->getFilename() == 'public') {
                return true;
            }
        }
        return false;
    }

    public function saveModule($module, $signature) {
        $isSystem = 0;
        if (!(strpos($module, '-system') === false)) {
            $isSystem = 1;
        }
        $module = $this->reformatName($module);
        if ($this->isUnique($module, $isSystem, $signature)) {
            $moduleEntity = $this->newEntity(['name' => $module, 'handle' => strtolower($module), 'is_system' => $isSystem, 'signature' => $signature]);
            $this->save($moduleEntity);
        }
        return $this->find()->where(['name' => $module])->first();
    }

    public function reformatName($name) {
        if (strpos($name, '-system') === false) {
            return $name;
        }
        return explode('-', $name)[0];
    }

    public function purge($signature) {
        return $this->deleteAll([function($exp) use ($signature) {
                        return $exp->not(['signature' => $signature]);
                    }]
                );
            }

        }
        
