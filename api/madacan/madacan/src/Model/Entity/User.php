<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $nom
 * @property string $prenom
 * @property string $email
 * @property string|null $phone
 * @property string|null $adresse
 * @property \Cake\I18n\FrozenTime|null $naissance
 * @property \Cake\I18n\FrozenTime $inscription
 * @property int|null $level
 * @property bool|null $active
 * @property string $password
 * @property bool|null $connected
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property \Cake\I18n\FrozenTime|null $deleted
 *
 * @property \App\Model\Entity\Evaluation[] $evaluation
 * @property \App\Model\Entity\Formation[] $formation
 */
class User extends Entity
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
        'nom' => true,
        'prenom' => true,
        'email' => true,
        'phone' => true,
        'adresse' => true,
        'naissance' => true,
        'inscription' => true,
        'level' => true,
        'active' => true,
        'password' => true,
        'connected' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'evaluation' => true,
        'formation' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];
}
