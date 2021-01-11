<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Title Entity
 *
 * @property int $title_no
 * @property string $title
 * @property string $description
 *
 * @property \App\Model\Entity\Vacancy[] $vacancies
 * @property \App\Model\Entity\EmployeeTitle[] $employee_title
 */
class Title extends Entity
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
        'title' => true,
        'description' => true,
        'vacancies' => true,
        'employee_title' => true,
    ];
}
