<?php

declare(strict_types = 1);

namespace MakvilleAcl\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Roles Model
 *
 * @property \MakvilleAcl\Model\Table\RoleActionsTable&\Cake\ORM\Association\HasMany $RoleActions
 * @property \MakvilleAcl\Model\Table\UserRolesTable&\Cake\ORM\Association\HasMany $UserRoles
 *
 * @method \MakvilleAcl\Model\Entity\Role get($primaryKey, $options = [])
 * @method \MakvilleAcl\Model\Entity\Role newEntity($data = null, array $options = [])
 * @method \MakvilleAcl\Model\Entity\Role[] newEntities(array $data, array $options = [])
 * @method \MakvilleAcl\Model\Entity\Role|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MakvilleAcl\Model\Entity\Role saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MakvilleAcl\Model\Entity\Role patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \MakvilleAcl\Model\Entity\Role[] patchEntities($entities, array $data, array $options = [])
 * @method \MakvilleAcl\Model\Entity\Role findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RolesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void {
        parent::initialize($config);

        $this->setTable('roles');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('RoleActions', [
            'foreignKey' => 'role_id',
            'className' => 'MakvilleAcl.RoleActions',
        ]);
        $this->hasMany('UserRoles', [
            'foreignKey' => 'role_id',
            'className' => 'MakvilleAcl.UserRoles',
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
                ->allowEmptyString('id', null, 'create');

        $validator
                ->scalar('name')
                ->maxLength('name', 255)
                ->allowEmptyString('name');

        $validator
                ->scalar('description')
                ->maxLength('description', 255)
                ->allowEmptyString('description');

        return $validator;
    }
    
    public function isMember($id, $userId) {
        return $this->UserRoles->find()->where(['role_id' => $id, 'user_id' => $userId])->count() == 1;
    }
    
    public function assignMember($id, $userId, $assignedBy) {
        if (!$this->isMember($id, $userId)) {
            $membership = $this->UserRoles->newEntity(['role_id' => $id, 'user_id' => $userId, 'assigned_by' => $assignedBy]);
            return $this->UserRoles->save($membership);
        }
        return false;
    }
    
    public function unAssignMember($id, $userId) {
        $membership = $this->UserRoles->find()->where(['role_id' => $id, 'user_id' => $userId])->first();
        return $this->UserRoles->delete($membership);
    }
    
    public function isDuty ($id, $moduleActionId) {
        return $this->RoleActions->find()->where(['role_id' => $id, 'module_action_id' =>$moduleActionId])->count() == 1;
    }
    
    public function assignDuty($id, $moduleActionId, $assignedBy) {
        if (!$this->isDuty($id, $moduleActionId)) {
            $duty = $this->RoleActions->newEntity(['role_id' => $id, 'module_action_id' => $moduleActionId, 'assigned_by' => $assignedBy]);
            return $this->RoleActions->save($duty);
        }
        return false;
    }
    
    public function unAssignDuty($id, $moduleActionId) {
        $duty = $this->RoleActions->find()->where(['role_id' => $id, 'module_action_id' => $moduleActionId])->first();
        return $this->RoleActions->delete($duty);
    }
}
