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
        $this->Authentication->addUnauthenticatedActions(['login', 'add', 'edit']);
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
    public function view($id = null)
    {
        $employee = $this->Employees->get($id, [
            // 'contain' => ['salaries','titles'],
        ]);
        
        // $titles = $employee->titles;
        // $today = new \DateTime();
        // foreach($titles as $title) {
        //     $date = new \DateTime($title->to_date->format('Y-m-d'));
            
        //     if($date > $today) {
        //         $employee->fonction = $title->title;
        //         break;
        //     }
        // }

        $this->set(compact('employee'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        //Récupérer => Créer
        $employee = $this->Employees->newEmptyEntity();
        
        //Traitement
        //Rien faire en GET
        //Persister en POST
        if ($this->request->is('post')) {
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee could not be saved. Please, try again.'));
        }
        
        //Envoyer vers la vue
        $this->set(compact('employee'));
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
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());
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
    public function delete($id = null)
    {
        //Sécurité
        $this->request->allowMethod(['post', 'delete']);
        
        //Récupérer
        $employee = $this->Employees->get($id);
        
        //Traitement
        if ($this->Employees->delete($employee)) {
            $this->Flash->success(__('The employee has been deleted.'));
        } else {
            $this->Flash->error(__('The employee could not be deleted. Please, try again.'));
        }

        //Envoyer vers la vue: NON => Redirection
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
