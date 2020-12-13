<?php
declare(strict_types=1);

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Inbox cell
 */
class WomenRatioCell extends Cell
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
        $this->loadModel('Employees');
        
        $men = $this->Employees->findByGender('M')->count();
        $women = $this->Employees->findByGender('F')->count();
        $other = $this->Employees->findByGender('X')->count();
       
        
        //envoie le résultat a la cell
        $this->set(compact('men'));
        $this->set(compact('women'));
        $this->set(compact('other'));
    }
}
