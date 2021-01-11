<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\ORM\Query;
use App\Controller\PieChart;
/**
 * Departments Controller
 *
 * @property \App\Model\Table\DepartmentsTable $Departments
 * @method \App\Model\Entity\Department[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DepartmentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // Récupération des départements et du contenu de la talbe "dept_manager" en lien avec le département
        $departments = $this->Departments->find();
        foreach ($departments as $department) {
            $dept_no = $department['dept_no'];

            // Récupération de l'entité du manager (c-a-d celui avec le champ "to_date" plus grand que la date actuelle)
            $manager = $this->Departments->Dept_manager->find()->select('emp_no')
                ->where([
                    'to_date >' => date('Y-m-d'),
                    'dept_no' => $dept_no
                ])
                ->toArray();

            // Récupération des infos (emp_no et picture) du manager
            // S'il n'y a pas de manager alors il vaudra null
            if (isset($manager[0])) {
                $emp_no = $manager[0]['emp_no'];

                $picture = $this->Departments->Employees->find()
                    ->select(['emp_no', 'picture'])
                    ->where(['emp_no' => $emp_no])
                    ->toArray();

                $managers[$dept_no] = ['emp_no' => $picture[0]['emp_no'], 'picture' => $picture[0]['picture']];
            } else {
                $managers[$dept_no] = null;
            }
            
            // Comptage des employés du département
            $nbEmployees = $this->Departments->Dept_emp->find()->where(['dept_no' => $dept_no])->count();

            $employeesNumber[$dept_no] = $nbEmployees;

            $query = $this->Departments->Vacancies->find()->where(['dept_no' => $dept_no]);

            $nbPosteVacant = 0;
            foreach ($query as $posteVacant) {
                $nbPosteVacant += $posteVacant['quantity'];
            }

            $postesVacants[$dept_no] = $nbPosteVacant;
        }

        // Gestion du ROI
        $dept_working = null;
        if ($this->Authentication->getIdentity() !== null) {
            $user = $this->Authentication->getIdentity();

            $query = $this->Departments->Dept_emp->find();

            $dept_working = $query->select('dept_no')->where([
                'emp_no' => $user->emp_no,
                'to_date >' => date('Y-m-d'),
            ])->first();
            
            $dept_working = $dept_working->dept_no;
        }

        $departments = $this->paginate($this->Departments);

        $this->set(compact('departments'));
        $this->set(compact('managers'));
        $this->set(compact('employeesNumber'));
        $this->set(compact('postesVacants'));
        $this->set(compact('postesVacants'));
        $this->set(compact('dept_working'));
    }

    /**
     * View method
     *
     * @param string|null $id Department id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $department = $this->Departments->get($id, [
            'contain' => [],
        ]);

        $employees = $this->Departments->Dept_emp->find()->where(['dept_no' => $id]);
        $employees = $this->paginate($employees);

        $managerNo = $this->Departments->Dept_manager->find()
            ->select('emp_no')
            ->where([
                'dept_no' => $id,
                'to_date >' => date('Y-m-d'),
            ])
            ->first();
            
        if (isset($managerNo)) {
            $managerNo = $managerNo->emp_no;

            $manager = $this->Departments->Employees->find()->where(['emp_no' => $managerNo])->toArray();
        } else {
            $manager = null;
        }
        
        
        $dept_working = null;
        if ($this->Authentication->getIdentity() !== null) {
            $user = $this->Authentication->getIdentity();

            $query = $this->Departments->Dept_emp->find();

            $dept_working = $query->select('dept_no')->where([
                'emp_no' => $user->emp_no,
                'to_date >' => date('Y-m-d'),
            ])->first();
            
            $dept_working = $dept_working->dept_no;
        }

        $this->set(compact('dept_working'));
        $this->set(compact('department'));
        $this->set(compact('employees'));
        $this->set(compact('manager'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $department = $this->Departments->newEmptyEntity();
        if ($this->request->is('post')) {
            $datas = $this->request->getData();

            $picture = $datas['picture'];
            $rules = $datas['rules'];

            $datas['picture'] = $picture->getClientFilename();
            $datas['rules'] = $rules->getClientFilename();

            // Gestion du dept_no
            $query = $this->Departments->find()->select('dept_no')->order(['dept_no' => 'DESC'])->first();
            $lastDeptNo = $query->dept_no;

            $lastDeptNo = (int) substr($lastDeptNo, -3);

            $newDeptNo = $lastDeptNo++;
            
            if ($lastDeptNo < 10) {
                $newDeptNo = 'd00' . $lastDeptNo;
            } elseif ($lastDeptNo >= 10 && $lastDeptNo <= 99) {
                $newDeptNo = 'd0' . $lastDeptNo;
            } elseif ($lastDeptNo >= 100) {
                $newDeptNo = 'd' . $lastDeptNo;
            }
            
            $datas['dept_no'] = $newDeptNo;

            // Gestion des fichiers
            if ($picture->getSize() > 500000 && $rules->getSize() > 500000) {
                $this->Flash->error(__('Fichiers trop volumineux !'));
            } elseif($picture->getClientMediaType() != 'image/jpeg' && $rules->getClientMediaType() != 'application/pdf') {
                $this->Flash->error(__('Fichiers pas de bon type !'));
            } else {
                $destination = WWW_ROOT . DS . 'img' . DS . 'department' . DS . $picture->getClientFilename();
                $picture->moveTo($destination);

                $destination = WWW_ROOT . DS . 'roi' . DS . $rules->getClientFilename();
                $rules->moveTo($destination);
            }

            $department = $this->Departments->patchEntity($department, $datas);

            if ($this->Departments->save($department)) {
                $this->Flash->success(__('The department has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The department could not be saved. Please, try again.'));
        }
        $this->set(compact('department'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Department id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $department = $this->Departments->get($id, [
            'contain' => [],
        ]);

        dd($department);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $department = $this->Departments->patchEntity($department, $this->request->getData());
            if ($this->Departments->save($department)) {
                $this->Flash->success(__('The department has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The department could not be saved. Please, try again.'));
        }
        $this->set(compact('department'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Department id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($dept_no = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $department = $this->Departments->get($dept_no);

        $nbEmployees = $this->Departments->Dept_emp->find()->where(['dept_no' => $dept_no])->count();

        if ($nbEmployees === 0) {
            if ($this->Departments->delete($department)) {
                $this->Flash->success(__('The department has been deleted.'));
            } else {
                $this->Flash->error(__('The department could not be deleted. Please, try again.'));
            }
        } else {
            $this->Flash->error(__('TVous ne pouvez pas supprimer un département avec des emplyés'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
