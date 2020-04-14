<?php
declare(strict_types=1);

namespace MakvilleAcl\Model\Entity;

use Cake\ORM\Entity;

/**
 * Module Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $version
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \MakvilleAcl\Model\Entity\ModuleActionGroup[] $module_action_groups
 * @property \MakvilleAcl\Model\Entity\ModuleAction[] $module_actions
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
        'name' => true,
        'description' => true,
        'version' => true,
        'created' => true,
        'modified' => true,
        'module_action_groups' => true,
        'module_actions' => true,
    ];
}
