<?php
declare(strict_types=1);

namespace MakvilleAcl\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserProfiles Model
 *
 * @property \MakvilleAcl\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \MakvilleAcl\Model\Table\UserProfileFieldsTable&\Cake\ORM\Association\BelongsTo $UserProfileFields
 *
 * @method \MakvilleAcl\Model\Entity\UserProfile get($primaryKey, $options = [])
 * @method \MakvilleAcl\Model\Entity\UserProfile newEntity($data = null, array $options = [])
 * @method \MakvilleAcl\Model\Entity\UserProfile[] newEntities(array $data, array $options = [])
 * @method \MakvilleAcl\Model\Entity\UserProfile|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MakvilleAcl\Model\Entity\UserProfile saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MakvilleAcl\Model\Entity\UserProfile patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \MakvilleAcl\Model\Entity\UserProfile[] patchEntities($entities, array $data, array $options = [])
 * @method \MakvilleAcl\Model\Entity\UserProfile findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserProfilesTable extends Table
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

        $this->setTable('user_profiles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'className' => 'MakvilleAcl.Users',
        ]);
        $this->belongsTo('UserProfileFields', [
            'foreignKey' => 'user_profile_field_id',
            'joinType' => 'INNER',
            'className' => 'MakvilleAcl.UserProfileFields',
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
            ->scalar('value')
            ->allowEmptyString('value');

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
        $rules->add($rules->existsIn(['user_profile_field_id'], 'UserProfileFields'));

        return $rules;
    }
}
