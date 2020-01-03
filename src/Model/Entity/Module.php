<?php
namespace Acl\Model\Entity;

use Cake\ORM\Entity;

/**
 * Module Entity
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $is_system
 * @property string $is_public
 *
 * @property \Acl\Model\Entity\ModuleActionGroup[] $module_action_groups
 * @property \Acl\Model\Entity\ModuleAction[] $module_actions
 */
class Module extends Entity
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
