<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EmployeeTitleFixture
 */
class EmployeeTitleFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'employee_title';
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'emp_no' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'title_no' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'from_date' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'to_date' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'title_no' => ['type' => 'index', 'columns' => ['title_no'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['emp_no', 'title_no', 'from_date'], 'length' => []],
            'employee_title_ibfk_2' => ['type' => 'foreign', 'columns' => ['title_no'], 'references' => ['titles', 'title_no'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'employee_title_ibfk_1' => ['type' => 'foreign', 'columns' => ['emp_no'], 'references' => ['employees', 'emp_no'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_general_ci'
        ],
    ];
    // phpcs:enable
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'emp_no' => 1,
                'title_no' => 1,
                'from_date' => '2021-01-04',
                'to_date' => '2021-01-04',
            ],
        ];
        parent::init();
    }
}
