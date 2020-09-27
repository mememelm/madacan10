<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Module Entity
 *
 * @property int $id
 * @property int|null $formation_id
 * @property string $intitule
 * @property string $description
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Formation $formation
 * @property \App\Model\Entity\Question[] $question
 * @property \App\Model\Entity\Support[] $support
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
        'formation_id' => true,
        'intitule' => true,
        'description' => true,
        'created' => true,
        'modified' => true,
        'formation' => true,
        'question' => true,
        'support' => true,
    ];
}
