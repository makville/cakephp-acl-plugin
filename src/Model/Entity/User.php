<?php

namespace MakvilleAcl\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $status
 * @property string $code
 * @property \Cake\I18n\Time $expiring
 * @property \Cake\I18n\Time $activated
 * @property string $is_system
 * @property string $is_global
 * @property string $db
 * @property string $owner
 * @property \Cake\I18n\Time $created
 * @property string $modified
 *
 * @property \Acl\Model\Entity\UserProfile[] $user_profiles
 * @property \Acl\Model\Entity\UserRole[] $user_roles
 */
class User extends Entity {

    /**
     * Fields that can be mass assigned using newEmptyEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    public function _setPassword($password) {
        return (new DefaultPasswordHasher)->hash($password);
    }

}
