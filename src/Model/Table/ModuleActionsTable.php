<?php

namespace MakvilleAcl\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ModuleActions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Modules
 * @property \Cake\ORM\Association\BelongsTo $ModuleActionGroups
 * @property \Cake\ORM\Association\HasMany $RoleActions
 *
 * @method \Acl\Model\Entity\ModuleAction get($primaryKey, $options = [])
 * @method \Acl\Model\Entity\ModuleAction newEntity($data = null, array $options = [])
 * @method \Acl\Model\Entity\ModuleAction[] newEntities(array $data, array $options = [])
 * @method \Acl\Model\Entity\ModuleAction|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Acl\Model\Entity\ModuleAction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Acl\Model\Entity\ModuleAction[] patchEntities($entities, array $data, array $options = [])
 * @method \Acl\Model\Entity\ModuleAction findOrCreate($search, callable $callback = null)
 */
class ModuleActionsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void {
        parent::initialize($config);

        $this->setTable('module_actions');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Modules', [
            'foreignKey' => 'module_id',
            'className' => 'Acl.Modules'
        ]);
        $this->belongsTo('ModuleActionGroups', [
            'foreignKey' => 'module_action_group_id',
            'className' => 'Acl.ModuleActionGroups'
        ]);
        $this->hasMany('RoleActions', [
            'foreignKey' => 'module_action_id',
            'className' => 'Acl.RoleActions'
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
                ->allowEmpty('handle');

        $validator
                ->allowEmpty('is_system');

        $validator
                ->allowEmpty('is_public');

        $validator
                ->allowEmpty('ownership_check');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker {
        $rules->add($rules->existsIn(['module_id'], 'Modules'));
        $rules->add($rules->existsIn(['module_action_group_id'], 'ModuleActionGroups'));

        return $rules;
    }

    public function isUnique($moduleId, $groupId, $action, $signature) {
        $ownership = 0;
        if ($action['has_ownership']) {
            $ownership = 1;
        }
        $isSystem = 0;
        if ($action['is_system']) {
            $isSystem = 1;
        }
        $isPublic = 0;
        if ($action['is_public']) {
            $isPublic = 1;
        }
        if ($this->find()->where(['module_id' => $moduleId, 'module_action_group_id' => $groupId, 'name' => $action['name']])->count() == 0) {
            return true;
        }
        //confirm if it has ownership and system status
        $actionEntity = $this->find()->where(['module_id' => $moduleId, 'module_action_group_id' => $groupId, 'name' => $action['name']])->first();
        $actionEntity->signature = $signature;
        if ($actionEntity->ownership_check != $ownership) {
            $actionEntity->ownership_check = $ownership;
        }
        if ($actionEntity->is_system != $isSystem) {
            $actionEntity->is_system = $isSystem;
        }
        if ($actionEntity->is_public != $isPublic) {
            $actionEntity->is_public = $isPublic;
        }
        $this->save($actionEntity);
        return false;
    }

    public function hasOwnershipCheck($path) {
        if (strpos(substr(file_get_contents($path), 0, 100), 'OwnershipCheck = true') === false) {
            return false;
        }
        return true;
    }

    public function isSystem($path) {
        if (strpos(substr(file_get_contents($path), 0, 100), 'IsSystem = true') === false) {
            return false;
        }
        return true;
    }

    public function isPublic($path) {
        if (strpos(substr(file_get_contents($path), 0, 100), 'IsPublic = true') === false) {
            return false;
        }
        return true;
    }

    public function purge($signature) {
        return $this->deleteAll([function($exp) use ($signature) {
                        return $exp->not(['signature' => $signature]);
                    }]
                );
            }

        }
        
