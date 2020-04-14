<?php
declare(strict_types=1);

namespace MakvilleAcl\Model\Entity;

use Cake\ORM\Entity;

/**
 * RoleAction Entity
 *
 * @property int $id
 * @property int|null $role_id
 * @property int|null $module_action_id
 * @property int|null $assigned_by
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \MakvilleAcl\Model\Entity\Role $role
 * @property \MakvilleAcl\Model\Entity\ModuleAction $module_action
 */
class RoleAction extends Entity
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
        'role_id' => true,
        'module_action_id' => true,
        'assigned_by' => true,
        'created' => true,
        'modified' => true,
        'role' => true,
        'module_action' => true,
    ];
}
