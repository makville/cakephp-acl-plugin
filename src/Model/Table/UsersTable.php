<?php

declare(strict_types = 1);

namespace MakvilleAcl\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \MakvilleAcl\Model\Table\UserProfilesTable&\Cake\ORM\Association\HasMany $UserProfiles
 * @property \MakvilleAcl\Model\Table\UserRolesTable&\Cake\ORM\Association\HasMany $UserRoles
 *
 * @method \MakvilleAcl\Model\Entity\User get($primaryKey, $options = [])
 * @method \MakvilleAcl\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \MakvilleAcl\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \MakvilleAcl\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MakvilleAcl\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MakvilleAcl\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \MakvilleAcl\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \MakvilleAcl\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('UserProfiles', [
            'foreignKey' => 'user_id',
            'className' => 'MakvilleAcl.UserProfiles',
        ]);
        $this->hasMany('UserRoles', [
            'foreignKey' => 'user_id',
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
                ->scalar('username')
                ->maxLength('username', 255)
                ->allowEmptyString('username');

        $validator
                ->email('email')
                ->allowEmptyString('email');

        $validator
                ->scalar('password')
                ->maxLength('password', 255)
                ->allowEmptyString('password');

        $validator
                ->scalar('status')
                ->maxLength('status', 255)
                ->allowEmptyString('status');

        $validator
                ->scalar('code')
                ->maxLength('code', 255)
                ->allowEmptyString('code');

        $validator
                ->dateTime('expiring')
                ->allowEmptyDateTime('expiring');

        $validator
                ->dateTime('activated')
                ->allowEmptyDateTime('activated');

        $validator
                ->scalar('owner')
                ->maxLength('owner', 255)
                ->allowEmptyString('owner');

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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }

    public function generateActivationToken() {
        return sha1(md5(date('Y-m-d H:i:s') . mt_rand(1000, 9999)));
    }

    public function generate2fToken() {
        return mt_rand(100000, 999999);
    }

    public function isValidCode($email, $code) {
        $user = $this->getUserByEmail($email);
        if ($user) {
            $now = new \Cake\Chronos\Chronos();
            if ($user->expiring > $now) {
                if ($user->code == $code) {
                    return true;
                }
            }
        }
        return false;
    }
    
    public function isValidEmail($email) {
        $user = $this->getUserByEmail($email);
        if ($user) {
            return true;
        }
        return false;
    }

    public function getUserByEmail($email) {
        return $this->find()->where(['email' => $email])->contain(['UserProfiles'])->first();
    }

    public function activate($email) {
        $user = $this->getUserByEmail($email);
        $user->status = 'active';
        $user->code = '';
        $user->activated = new \Cake\Chronos\Chronos();
        $user->expiring = null;
        return $this->save($user);
    }

    public function deactivate($email) {
        $user = $this->getUserByEmail($email);
        $user->status = 'inactive';
        return $this->save($user);
    }

    public function isActivated($email) {
        $user = $this->getUserByEmail($email);
        if ($user) {
            return $user->status == 'active';
        }
        return false;
    }

    public function getUserProfile($email, $list = false) {
        $user = $this->getUserByEmail($email);
        if ($list) {
            $profileList = [];
            foreach ($user->user_profiles as $profile) {
                $profileList[$profile->user_profile_field_id] = ['value' => $profile->value, 'id' => $profile->id];
            }
            return $profileList;
        }
        return $user->user_profiles;
    }

    public function getRoles($user) {
        $roles = [];
        $hydratedUser = $this->get($user->id, ['contain' => ['UserRoles' => ['Roles']]]);
        foreach ($hydratedUser->user_roles as $userRole) {
            $roles[] = $userRole->role->id;
        }
        return $roles;
    }

}
