<?php
declare(strict_types=1);

namespace MakvilleAcl\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserProfile Entity
 *
 * @property int $id
 * @property int|null $user_id
 * @property int $user_profile_field_id
 * @property string|null $value
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \MakvilleAcl\Model\Entity\User $user
 * @property \MakvilleAcl\Model\Entity\UserProfileField $user_profile_field
 */
class UserProfile extends Entity
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
        'user_id' => true,
        'user_profile_field_id' => true,
        'value' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'user_profile_field' => true,
    ];
}
