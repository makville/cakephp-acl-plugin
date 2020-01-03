<?php
namespace MakvilleAcl\Model\Entity;

use Cake\ORM\Entity;

/**
 * ModuleAction Entity
 *
 * @property int $id
 * @property int $module_id
 * @property int $module_action_group_id
 * @property string $name
 * @property string $description
 * @property string $handle
 * @property string $is_system
 * @property string $is_public
 * @property string $ownership_check
 *
 * @property \Acl\Model\Entity\Module $module
 * @property \Acl\Model\Entity\ModuleActionGroup $module_action_group
 * @property \Acl\Model\Entity\RoleAction[] $role_actions
 */
class ModuleAction extends Entity
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
        '*' => true,
        'id' => false
    ];
}
