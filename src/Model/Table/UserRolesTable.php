<?php
declare(strict_types=1);

namespace MakvilleAcl\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserRoles Model
 *
 * @property \MakvilleAcl\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \MakvilleAcl\Model\Table\RolesTable&\Cake\ORM\Association\BelongsTo $Roles
 *
 * @method \MakvilleAcl\Model\Entity\UserRole get($primaryKey, $options = [])
 * @method \MakvilleAcl\Model\Entity\UserRole newEntity($data = null, array $options = [])
 * @method \MakvilleAcl\Model\Entity\UserRole[] newEntities(array $data, array $options = [])
 * @method \MakvilleAcl\Model\Entity\UserRole|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MakvilleAcl\Model\Entity\UserRole saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MakvilleAcl\Model\Entity\UserRole patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \MakvilleAcl\Model\Entity\UserRole[] patchEntities($entities, array $data, array $options = [])
 * @method \MakvilleAcl\Model\Entity\UserRole findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserRolesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('user_roles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'className' => 'MakvilleAcl.Users',
        ]);
        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'className' => 'MakvilleAcl.Roles',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->integer('assigned_by')
            ->allowEmptyString('assigned_by');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));

        return $rules;
    }
}
