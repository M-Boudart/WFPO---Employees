<?php
declare(strict_types=1);

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Inbox cell
 */
class WomenCourbeCell extends Cell
{
    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Initialization logic run at the end of object construction.
     *
     * @return void
     */
    public function initialize(): void
    {
    }

   

    public function display(){

        $this->loadModel('Employees');
        $aze = $this->Employees->find()->where([
            'emp_no >' => 10020,
        ])->group('last_name');

        // $women->select([
        //     'year' => 'hire_date',
        //     'count' => $women->func()->count('emp_no'),
        // ])
        //     ->group('hire_date')->first();

        $this->set(compact('aze'));
    }
}
