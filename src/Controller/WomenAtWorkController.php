<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\ORM\Query;
use App\Controller\PieChart;
use Cake\View\CellTrait;
/**
 * Departments Controller
 *
 * @property \App\Model\Table\DepartmentsTable $Departments
 * @method \App\Model\Entity\Department[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WomenAtWorkController extends AppController
{
    use CellTrait;
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
    
        $cellWomenRatio = $this->cell('WomenRatio');
        $cellWomenCourbe = $this->cell("WomenCourbe");
        $cellWomenData = $this->cell("WomenData");
        

        $this->set(compact('cellWomenRatio'));
        $this->set(compact('cellWomenCourbe'));
        $this->set(compact('cellWomenData'));
       
       
      

    }

   
}
