<?php
declare(strict_types=1);

namespace MakvilleAcl\Model\Entity;

use Cake\ORM\Entity;

/**
 * ModuleAction Entity
 *
 * @property int $id
 * @property int|null $module_id
 * @property int|null $duty_id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $handle
 * @property string|null $ownership_check
 *
 * @property \MakvilleAcl\Model\Entity\Module $module
 * @property \MakvilleAcl\Model\Entity\Duty $duty
 * @property \MakvilleAcl\Model\Entity\RoleAction[] $role_actions
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
        'module_id' => true,
        'duty_id' => true,
        'name' => true,
        'description' => true,
        'handle' => true,
        'ownership_check' => true,
        'module' => true,
        'duty' => true,
        'role_actions' => true,
    ];
}
