<?php

namespace MakvilleAcl\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Carbon\Carbon;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\HasMany $UserProfiles
 * @property \Cake\ORM\Association\HasMany $UserRoles
 *
 * @method \Acl\Model\Entity\User get($primaryKey, $options = [])
 * @method \Acl\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \Acl\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \Acl\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Acl\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Acl\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \Acl\Model\Entity\User findOrCreate($search, callable $callback = null)
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

        $this->hasOne('UserProfiles', [
            'foreignKey' => 'user_id',
            'className' => 'Acl.UserProfiles',
            'dependent' => true
        ]);
        $this->hasMany('UserRoles', [
            'foreignKey' => 'user_id',
            'className' => 'Acl.UserRoles'
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
                ->email('email')
                ->allowEmpty('email');

        $validator
                ->allowEmpty('password');

        $validator
                ->allowEmpty('status');

        $validator
                ->allowEmpty('code');

        $validator
                ->dateTime('expiring')
                ->allowEmpty('expiring');

        $validator
                ->dateTime('activated')
                ->allowEmpty('activated');

        $validator
                ->allowEmpty('is_system');

        $validator
                ->allowEmpty('is_global');

        $validator
                ->allowEmpty('db');

        $validator
                ->allowEmpty('owner');

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
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }

    public function isValidCode($email, $code) {
        $now = date('Y-m-d H:i:s');
        if ($this->find('all')->where(['email' => $email, 'code' => $code])->andWhere([function($exp) use ($now) {
                    return $exp->gt('expiring', $now, 'datetime');
                }])->count() == 1) {
            return true;
        }
        return false;
    }

    public function activate($email) {
        //get the user
        $user = $this->getUser($email);
        $user->code = '';
        $user->status = 'active';
        $user->activated = new Carbon(null, 'Africa/Lagos');
        return $this->save($user);
    }

    public function isValidEmail($email) {
        if ($this->find('all')->where(['email' => $email])->count() == 1) {
            return true;
        }
        return false;
    }

    public function isActivated($email) {
        $user = $this->getUser($email);
        if ($user->status == 'active') {
            return true;
        }
        return false;
    }

    public function reset($email, $code, $password) {
        //do we have a valid email address
        if ($this->isValidCode($email, $code)) {
            //reset the user
            $user = $this->getUser($email);
            $user->status = 'active';
            $user->code = '';
            $user->password = $password;
            return $this->save($user);
        }
    }

    public function changePassword($email, $password) {
        $user = $this->getUser($email);
        $user->password = $password;
        return $this->save($user);
    }

    public function generateToken() {
        return md5(sha1(mt_rand(1000, 9999) . date('Y-m-d H:i:s') . mt_rand(10000, 99999)));
    }

    public function getUser($email) {
        return $this->find()->where(['email' => $email])->first();
    }

    public function isUserId($id) {
        if ($this->find()->where(['id' => $id])->count() == 1) {
            return true;
        }
        return false;
    }

    public function getName($id) {
        $profile = $this->UserProfiles->getUserProfile($id);
        return $profile->name;
    }
    
    public function isAuthorized($id, $action) {
        return true;
        //get the action
        $actionEntity = $this->UserRoles->Roles->RoleActions->ModuleActions->find()->where(['handle' => $action])->first();
        $userEntity = $this->get($id);
        if ($actionEntity->is_public == 1) {
            return true;
        } else {
            if ($this->UserRoles->Roles->find()
                    ->leftJoin(['UserRoles' => 'user_roles'], ['UserRoles.role_id = Roles.id'])
                    ->leftJoin(['RoleActions' => 'role_actions'], ['RoleActions.role_id = Roles.id'])
                    ->where(['UserRoles.user_id' => $id, 'RoleActions.module_action_id' => $actionEntity->id])
                    ->count() > 0) {
                //system requirements
                if ( $actionEntity->is_system == 1 ) {
                    if ( $userEntity->is_system == 1 ) {
                        return true;
                    } else {
                        return false;
                    }
                }
                return true;
            }
        }
        return false;
    }

    public function getCurrentRoles($id) {
        //get the user's roles left joined with roles
        $roles = $this->UserRoles->Roles->find('list')
            ->leftJoin(['UserRoles' => 'user_roles'], ['UserRoles.role_id = Roles.id'])
            ->where(['UserRoles.user_id' => $id]);
        return $roles->toArray();
    }
}
