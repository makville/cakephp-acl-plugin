<?php

declare(strict_types = 1);

namespace MakvilleAcl\Model\Entity;

use Cake\ORM\Entity;
use Authentication\PasswordHasher\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $email
 * @property string|null $password
 * @property string|null $status
 * @property string|null $code
 * @property \Cake\I18n\FrozenTime|null $expiring
 * @property \Cake\I18n\FrozenTime|null $activated
 * @property string|null $owner
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \MakvilleAcl\Model\Entity\UserProfile[] $user_profiles
 * @property \MakvilleAcl\Model\Entity\UserRole[] $user_roles
 */
class User extends Entity {

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'username' => true,
        'email' => true,
        'password' => true,
        'status' => true,
        'code' => true,
        'expiring' => true,
        'activated' => true,
        'owner' => true,
        'created' => true,
        'modified' => true,
        'user_profiles' => true,
        'user_roles' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];

    protected function _setPassword(string $password) {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($password);
    }
}
