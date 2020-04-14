<?php
declare(strict_types=1);

namespace MakvilleAcl\Model\Entity;

use Cake\ORM\Entity;

/**
 * Duty Entity
 *
 * @property int $id
 * @property int|null $module_id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $handle
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \MakvilleAcl\Model\Entity\Module $module
 */
class Duty extends Entity
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
        'name' => true,
        'description' => true,
        'handle' => true,
        'created' => true,
        'modified' => true,
        'module' => true,
    ];
}
