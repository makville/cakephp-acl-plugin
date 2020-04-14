<?php
declare(strict_types=1);

namespace MakvilleAcl\Model\Entity;

use Cake\ORM\Entity;

/**
 * Role Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \MakvilleAcl\Model\Entity\RoleAction[] $role_actions
 * @property \MakvilleAcl\Model\Entity\UserRole[] $user_roles
 */
class Role extends Entity
{
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
        'name' => true,
        'description' => true,
        'created' => true,
        'modified' => true,
        'role_actions' => true,
        'user_roles' => true,
    ];
}
