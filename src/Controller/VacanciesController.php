<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Vacancies Controller
 *
 * @property \App\Model\Table\VacanciesTable $Vacancies
 * @method \App\Model\Entity\Vacancy[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VacanciesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $vacancies = $this->paginate($this->Vacancies);

        $this->set(compact('vacancies'));
    }

    /**
     * View method
     *
     * @param string|null $id Vacancy id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vacancy = $this->Vacancies->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('vacancy'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $vacancy = $this->Vacancies->newEmptyEntity();
        if ($this->request->is('post')) {
            $vacancy = $this->Vacancies->patchEntity($vacancy, $this->request->getData());
            if ($this->Vacancies->save($vacancy)) {
                $this->Flash->success(__('The vacancy has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vacancy could not be saved. Please, try again.'));
        }
        $this->set(compact('vacancy'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Vacancy id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $vacancy = $this->Vacancies->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vacancy = $this->Vacancies->patchEntity($vacancy, $this->request->getData());
            if ($this->Vacancies->save($vacancy)) {
                $this->Flash->success(__('The vacancy has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vacancy could not be saved. Please, try again.'));
        }
        $this->set(compact('vacancy'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Vacancy id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vacancy = $this->Vacancies->get($id);
        if ($this->Vacancies->delete($vacancy)) {
            $this->Flash->success(__('The vacancy has been deleted.'));
        } else {
            $this->Flash->error(__('The vacancy could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    /**
     * Displays all the jobs offers for a department.
     * 
     * @param string $dept_no Department'id.
     * @return \Cake\Http\Response|null|void Redirects to apply.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function displayJobsOffers(string $dept_no) {
        $vacancies = $this->Vacancies->find('all', ['contain' => 'Titles'])->where(['dept_no' => $dept_no]);
        
        $this->set(compact('vacancies'));
        $this->set(compact('dept_no'));
    }
    /**
     * Apply for a job
     * 
     * @param string $dept_no Department'id
     * @return \Cake\Http\Response|null|void Redirects to apply.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function apply(string $dept_no) {
        
    }
}
