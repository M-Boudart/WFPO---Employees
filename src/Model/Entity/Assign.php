<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Assign Entity
 *
 * @property int $id
 * @property string $dept_no
 * @property int $title_no
 * @property string $last_name
 * @property string $first_name
 * @property string $gender
 * @property \Cake\I18n\FrozenDate $birthdate
 * @property string $email
 * @property string $cv
 */
class Assign extends Entity
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
        'dept_no' => true,
        'title_no' => true,
        'last_name' => true,
        'first_name' => true,
        'gender' => true,
        'birthdate' => true,
        'email' => true,
        'cv' => true,
    ];
}
