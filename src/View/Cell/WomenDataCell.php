<?php
declare(strict_types=1);

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Inbox cell
 */
class WomenDataCell extends Cell
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

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
        // SQL
        // SELECT COUNT(employees.emp_no),departments.dept_name
        // FROM employees
        // JOIN dept_emp on dept_emp.emp_no=employees.emp_no
        // JOIN departments on departments.dept_no=dept_emp.dept_no
        // WHERE employees.gender="F"
        // GROUP BY departments.dept_name

         /**
         * Récupération du nombre de femmes par année
         */

         //•	Les 3 départements présentant le plus de femmes
         // •	Les 3 départements présentant le moins de femmes
         //•	Le nombre de femmes manager


        //SELECT COUNT(dept_manager.emp_no)
            // FROM dept_manager
            // JOIN employees on employees.emp_no=dept_manager.emp_no
            // WHERE employees.gender="F"


         /**
         * Récupération des femmes managers (noms + nombre)
         */
        $query = $this->getTableLocator()->get('employees')
            ->find()
            ->select([
                'employees.first_name',
                'employees.last_name',
                'employees.emp_no',
            ])
            ->join([
                'emti' => [
                    'table' => 'employee_title',
                    'conditions' => 'emti.emp_no = employees.emp_no'
                ],
            ])
            ->where([
                'emti.title_no' => '7',
                'employees.gender' => 'F'
            ]);

        $results = $query->all();

        $femaleManagers = [];
        $cptManagers = 0;

        foreach ($results as $row) {
            $femaleManagers[] = $row["first_name"] . " " . $row["last_name"];
            $cptManagers++;
        }

         //envoie le résultat a la cell
         $this->set(compact('femaleManagers'));
         
       
    }
}
