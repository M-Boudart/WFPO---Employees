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



    public function display()
    {

        /**
         * Récupération du nombre de femmes par année
         */

        $arrNbWomen = [];
        $arrYears = [];

        //Query
        $query = $this->getTableLocator()->get('employees')->find();
        $query->select([
            'nbFemmes' => $query->func()->count('employees.emp_no'),
            'hire_date'
        ])
            ->where([
                'gender' => 'F',
            ])
            ->group([
                'hire_date'
            ]);

        $result = $query->all();

        foreach ($result as $row) {
            $arrNbWomen[] = $row->nbFemmes;

            //GET years

            $years = $row->hire_date->format('Y');
            if (!in_array($years, $arrYears, true)) {
                $arrYears[] = $years;
            }

            //envoie le résultat a la cell
            $this->set(compact('arrNbWomen'));
            $this->set(compact('arrYears'));
        };

        // $this->loadModel('Employees');
        
        // $women = $this->Employees->findByGender('F')->count();
        // $date = $this->Employees->group('hired_date');

        //  //envoie le résultat a la cell
        //  $this->set(compact('women'));
        //  $this->set(compact('date'));
        
    }
}
