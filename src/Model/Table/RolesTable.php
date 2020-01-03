<?php

namespace Acl\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Roles Model
 *
 * @property \Cake\ORM\Association\HasMany $RoleActions
 * @property \Cake\ORM\Association\HasMany $UserRoles
 *
 * @method \Acl\Model\Entity\Role get($primaryKey, $options = [])
 * @method \Acl\Model\Entity\Role newEntity($data = null, array $options = [])
 * @method \Acl\Model\Entity\Role[] newEntities(array $data, array $options = [])
 * @method \Acl\Model\Entity\Role|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Acl\Model\Entity\Role patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Acl\Model\Entity\Role[] patchEntities($entities, array $data, array $options = [])
 * @method \Acl\Model\Entity\Role findOrCreate($search, callable $callback = null)
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
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('roles');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('RoleActions', [
            'foreignKey' => 'role_id',
            'className' => 'Acl.RoleActions'
        ]);
        $this->hasMany('UserRoles', [
            'foreignKey' => 'role_id',
            'className' => 'Acl.UserRoles'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->integer('id')
                ->allowEmpty('id', 'create');

        $validator
                ->allowEmpty('name');

        $validator
                ->allowEmpty('description');

        return $validator;
    }

    public function getRolePrivileges($id) {
        return $this->RoleActions->ModuleActions->find('list')
                        ->leftJoin(['RoleActions' => 'role_actions'], ['RoleActions.module_action_id = ModuleActions.id'])
                        ->where(['RoleActions.role_id' => $id])
                        ->toArray();
    }

}
