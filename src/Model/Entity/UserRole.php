<?php
namespace MakvilleAcl\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserRole Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $role_id
 * @property int $assigned_by
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \Acl\Model\Entity\User $user
 * @property \Acl\Model\Entity\Role $role
 */
class UserRole extends Entity
{

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
}
