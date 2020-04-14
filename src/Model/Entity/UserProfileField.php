<?php
declare(strict_types=1);

namespace MakvilleAcl\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserProfileField Entity
 *
 * @property int $id
 * @property string $name
 * @property string $label
 * @property string $required
 * @property string $input_type
 * @property string|null $option_source
 * @property string|null $options
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \MakvilleAcl\Model\Entity\UserProfile[] $user_profiles
 */
class UserProfileField extends Entity
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
        'label' => true,
        'required' => true,
        'input_type' => true,
        'option_source' => true,
        'options' => true,
        'created' => true,
        'modified' => true,
        'user_profiles' => true,
    ];
}
