<?php

namespace MakvilleAcl\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserProfiles Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \Acl\Model\Entity\UserProfile get($primaryKey, $options = [])
 * @method \Acl\Model\Entity\UserProfile newEntity($data = null, array $options = [])
 * @method \Acl\Model\Entity\UserProfile[] newEntities(array $data, array $options = [])
 * @method \Acl\Model\Entity\UserProfile|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Acl\Model\Entity\UserProfile patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Acl\Model\Entity\UserProfile[] patchEntities($entities, array $data, array $options = [])
 * @method \Acl\Model\Entity\UserProfile findOrCreate($search, callable $callback = null)
 */
class UserProfilesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void {
        parent::initialize($config);

        $this->setTable('user_profiles');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'className' => 'Acl.Users'
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }

    public function userHasProfile($userId) {
        if ($this->find()->where(['user_id' => $userId])->count() == 1) {
            return true;
        }
        return false;
    }

    public function getUserProfile($userId) {
        return $this->find()->where(['user_id' => $userId])->first();
    }

    public function createProfile($userId) {
        if (!$this->userHasProfile($userId) && $this->Users->isUserId($userId)) {
            $profile = $this->newEntity(['user_id' => $userId]);
            return $this->save($profile);
        }
        return false;
    }

}
