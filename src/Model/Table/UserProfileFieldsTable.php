<?php
declare(strict_types=1);

namespace MakvilleAcl\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserProfileFields Model
 *
 * @property \MakvilleAcl\Model\Table\UserProfilesTable&\Cake\ORM\Association\HasMany $UserProfiles
 *
 * @method \MakvilleAcl\Model\Entity\UserProfileField get($primaryKey, $options = [])
 * @method \MakvilleAcl\Model\Entity\UserProfileField newEntity($data = null, array $options = [])
 * @method \MakvilleAcl\Model\Entity\UserProfileField[] newEntities(array $data, array $options = [])
 * @method \MakvilleAcl\Model\Entity\UserProfileField|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MakvilleAcl\Model\Entity\UserProfileField saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MakvilleAcl\Model\Entity\UserProfileField patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \MakvilleAcl\Model\Entity\UserProfileField[] patchEntities($entities, array $data, array $options = [])
 * @method \MakvilleAcl\Model\Entity\UserProfileField findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserProfileFieldsTable extends Table
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

        $this->setTable('user_profile_fields');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('UserProfiles', [
            'foreignKey' => 'user_profile_field_id',
            'className' => 'MakvilleAcl.UserProfiles',
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('label')
            ->maxLength('label', 255)
            ->requirePresence('label', 'create')
            ->notEmptyString('label');

        $validator
            ->scalar('required')
            ->notEmptyString('required');

        $validator
            ->scalar('input_type')
            ->maxLength('input_type', 255)
            ->notEmptyString('input_type');

        $validator
            ->scalar('option_source')
            ->maxLength('option_source', 255)
            ->allowEmptyString('option_source');

        $validator
            ->scalar('options')
            ->allowEmptyString('options');

        return $validator;
    }
}
