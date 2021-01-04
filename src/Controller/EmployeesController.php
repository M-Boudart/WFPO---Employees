<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\View\CellTrait;

/**
 * Employees Controller
 *
 * @property \App\Model\Table\EmployeesTable $Employees
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmployeesController extends AppController
{
    use CellTrait;
    
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configurez l'action de connexion pour ne pas exiger d'authentification,
        // évitant ainsi le problème de la boucle de redirection infinie
        $this->Authentication->addUnauthenticatedActions(['login', 'add', 'edit', 'delete']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        //Récupérer les données de la base de données
        $employees = $this->Employees;
       
        //Préparer, modifier ces données
        $employees = $this->paginate($employees);
        
        $cellMenWomenRatio = $this->cell('Inbox');
        
        //Envoyer vers la vue
        $this->set('employees',$employees);
        $this->set('cellMenWomenRatio',$cellMenWomenRatio);
    }

    /**
     * View method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($emp_no)
    {
        $employee = $this->Employees->get($emp_no);
        
        $salary = $this->Employees->Salaries->find()
            ->select('salary')
            ->where([
                'emp_no' => $emp_no,
                'to_date >' => date('Y-m-d'),
            ])
            ->first();
        
        $department = $this->Employees->Dept_emp->find()
            ->select('dept_no')
            ->where([
                'emp_no' => $emp_no,
                'to_date >' => date('Y-m-d'),
            ])
            ->first();

        $titleNo = $this->Employees->Employee_title->find()
        ->select('title_no')
        ->where([
            'emp_no' => $emp_no,
            'to_date >' => date('Y-m-d'),
        ])
        ->first();
        $titleNo = $titleNo->title_no;

        $title = $this->Employees->Titles->find()
            ->select('title')
            ->where(['title_no' => $titleNo])
            ->first();
        
        $this->set(compact('employee'));
        $this->set(compact('salary'));
        $this->set(compact('department'));
        $this->set(compact('title'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        
        $employee = $this->Employees->newEmptyEntity();
        
        if ($this->request->is('post')) {
            // Gestion de l'ajout de l'employé
            $datas = $this->request->getData();

            if ($datas['birth_date'] < date('Y-m-d')) {
                $datas['hire_date'] = date('Y-m-d');

                $picture = $datas['picture'];

                $datas['picture'] = $picture->getClientFilename();

                $lastEmpNo = $this->Employees->find()->select('emp_no')->order(['emp_no' => 'DESC'])->first();
                $lastEmpNo = $lastEmpNo->emp_no;
                $lastEmpNo += 1;

                $datas['emp_no'] = $lastEmpNo;
                
                if ($picture->getSize() > 500000) {
                    $this->Flash->error(__('Fichiers trop volumineux !'));
                } elseif($picture->getClientMediaType() != 'image/jpeg') {
                    $this->Flash->error(__('Fichiers pas de bon type !'));
                } else {
                    $destination = WWW_ROOT . DS . 'img' . DS . 'employees' . DS . $picture->getClientFilename();
                    $picture->moveTo($destination);
                }

                $employee = $this->Employees->patchEntity($employee, $datas);

                if ($this->Employees->save($employee)) {
                    $query = $this->Employees->Dept_emp->query();
                    $result = $query->insert(['emp_no', 'dept_no', 'from_date', 'to_date'])
                                    ->values([
                                        'emp_no' => $lastEmpNo,
                                        'dept_no' => $datas['department'],
                                        'from_date' => date('Y-m-d'),
                                        'to_date' => '9999-01-01',
                                    ])
                                    ->execute();
                    
                    if ($result) {
                        $this->Flash->success(__('The employee has been saved.'));

                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error(__('The employee could not be saved. Please, try again.'));
                    }
                } else {
                    $this->Flash->error(__('The employee could not be saved. Please, try again.'));
                }
            } else {
                $this->Flash->error(__("Vous ne pouvez pas être né plustard que la date d'aujourd'hui"));
            }
        }

        $queryDepartments = $this->Employees->Departments->find()->select('dept_no')->order(['dept_no' => 'ASC']);
        
        $departments = [];
        foreach($queryDepartments as $department) {
            $key = $department->dept_no;
            $departments[$key] = $department->dept_no;
        }

        $this->set(compact('employee'));
        $this->set(compact('departments'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $employee = $this->Employees->get($id, [
            'contain' => [],
        ]);

        // $this->Authorization->authorize($employee, 'edit');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $datas = $this->request->getData();

            $picture = $datas['picture'];

            $datas['picture'] = $picture->getClientFilename();

            if ($picture->getSize() > 500000) {
                $this->Flash->error(__('Fichiers trop volumineux !'));
            } elseif($picture->getClientMediaType() != 'image/jpeg') {
                $this->Flash->error(__('Fichiers pas de bon type !'));
            } else {
                $destination = WWW_ROOT . DS . 'img' . DS . 'employees' . DS . $picture->getClientFilename();
                $picture->moveTo($destination);
            }

            $employee = $this->Employees->patchEntity($employee, $datas);

            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee could not be saved. Please, try again.'));
        }
        $this->set(compact('employee'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($emp_no = null)
    {
        //Sécurité
        $this->request->allowMethod(['post', 'delete']);
        
        //Récupérer
        $employee = $this->Employees->get($emp_no);
        //Traitement
        if ($this->Employees->delete($employee)) {
            $this->Flash->success(__('The employee has been deleted.'));
        } else {
            $this->Flash->error(__('The employee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function getAllByGender(string $gender = 'f') {
        //Récupérer les données
        $employees = $this->Employees->findByGender($gender)->limit(10);
        
        //Transformer
        $employees = $this->paginate($employees);
        
        //Envoyer à la vue
        $this->set('employees',$employees);
        $this->render('index'); //Définit un temlate spécifique
    }

    public function login()
    {
        // $this->Authorization->authorize('login');

        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        // indépendamment de POST ou GET, rediriger si l'utilisateur est connecté
        if ($result->isValid()) {
            // rediriger vers /articles après la connexion réussies
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Employees',
                'action' => 'index',
            ]);

            return $this->redirect($redirect);
        }
        
        // afficher une erreur si l'utilisateur a soumis le formulaire
        // et que l'authentification a échoué
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password'));
        }
    }

    public function logout()
    {
        $result = $this->Authentication->getResult();
        // indépendamment de POST ou GET, rediriger si l'utilisateur est connecté
        if ($result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['action' => 'login']);
        }
    }
}
