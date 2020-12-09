<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\ORM\Query;

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
        $departments = $this->Departments->find('all', ['contain' => ['Dept_manager']]);

        foreach($departments as $department) {
            $dept_no = $department['dept_no'];

            // Récupération de l'entité du manager (c-a-d celui avec le champ "to_date" plus grand que la date actuelle)
            $manager = $this->Departments->Dept_manager->find()->select('emp_no')
                ->where([
                    'to_date >' => '2020/12/08',
                    'dept_no' => $dept_no
                ])
                ->toArray();

            // Récupération du numéro d'employé du manager
            $emp_no = $manager[0]['emp_no'];

            // Récupération de "l'entité image" du manager
            $picture = $this->Departments->Employees->find()->select(['emp_no', 'picture'])->where(['emp_no' => $emp_no])->toArray();
            
            // Création du tableau contenant les managers (leur image et numéro d'employé)
            $managers[$dept_no] = ['emp_no' => $picture[0]['emp_no'], 'picture' => $picture[0]['picture']];
            
            // Nombre d'employés par département
            $nbEmployees = $this->Departments->Dept_emp->find()->where(['dept_no' => $dept_no])->count();

            $employeesNumber[$dept_no] = $nbEmployees;

            // Nombre de postes vacants par département
            $query = $this->Departments->Vacancies->find()->where(['dept_no' => $dept_no]);

            $nbPosteVacant = 0;
            foreach($query as $posteVacant) {
                $nbPosteVacant += $posteVacant['quantity'];
            }
            
            $postesVacants[$dept_no] = $nbPosteVacant;
            
        }

        $departments = $this->paginate($this->Departments);

        $this->set(compact('departments'));
        $this->set(compact('managers'));
        $this->set(compact('employeesNumber'));
        $this->set(compact('postesVacants'));
        $this->set(compact('postesVacants'));
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
        
        $this->set(compact('department'));
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
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $department = $this->Departments->get($id);
        if ($this->Departments->delete($department)) {
            $this->Flash->success(__('The department has been deleted.'));
        } else {
            $this->Flash->error(__('The department could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
