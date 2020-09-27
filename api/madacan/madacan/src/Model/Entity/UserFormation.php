<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserFormation Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $formation_id
 * @property \Cake\I18n\FrozenTime $date_debut
 * @property \Cake\I18n\FrozenTime $date_fin
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Formation $formation
 */
class UserFormation extends Entity
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
        'formation_id' => true,
        'date_debut' => true,
        'date_fin' => true,
        'user' => true,
        'formation' => true,
    ];
}
