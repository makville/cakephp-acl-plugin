<?php

namespace MakvilleAcl\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserRoles Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Roles
 *
 * @method \Acl\Model\Entity\UserRole get($primaryKey, $options = [])
 * @method \Acl\Model\Entity\UserRole newEntity($data = null, array $options = [])
 * @method \Acl\Model\Entity\UserRole[] newEntities(array $data, array $options = [])
 * @method \Acl\Model\Entity\UserRole|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Acl\Model\Entity\UserRole patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Acl\Model\Entity\UserRole[] patchEntities($entities, array $data, array $options = [])
 * @method \Acl\Model\Entity\UserRole findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserRolesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('user_roles');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'className' => 'Acl.Users'
        ]);
        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'className' => 'Acl.Roles'
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
                ->integer('assigned_by')
                ->allowEmpty('assigned_by');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));

        return $rules;
    }

    public function getUsersRoles($userId, $list = false) {
        if ($list) {
            return $this->find('list', ['keyField' => 'id', 'valueField' => 'role_id'])->where(['user_id' => $userId]);
        }
        return $this->find()->where(['user_id' => $userId]);
    }

    public function purgeUsersRoles($userId) {
        return $this->deleteAll(['user_id' => $userId]);
    }

}
