<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * DeptEmp Controller
 *
 * @property \App\Model\Table\DeptEmpTable $DeptEmp
 * @method \App\Model\Entity\DeptEmp[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DeptEmpController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $deptEmp = $this->paginate($this->DeptEmp);

        $this->set(compact('deptEmp'));
    }

    /**
     * View method
     *
     * @param string|null $id Dept Emp id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $deptEmp = $this->DeptEmp->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('deptEmp'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $deptEmp = $this->DeptEmp->newEmptyEntity();
        if ($this->request->is('post')) {
            $deptEmp = $this->DeptEmp->patchEntity($deptEmp, $this->request->getData());
            if ($this->DeptEmp->save($deptEmp)) {
                $this->Flash->success(__('The dept emp has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dept emp could not be saved. Please, try again.'));
        }
        $this->set(compact('deptEmp'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Dept Emp id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $deptEmp = $this->DeptEmp->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $deptEmp = $this->DeptEmp->patchEntity($deptEmp, $this->request->getData());
            if ($this->DeptEmp->save($deptEmp)) {
                $this->Flash->success(__('The dept emp has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dept emp could not be saved. Please, try again.'));
        }
        $this->set(compact('deptEmp'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Dept Emp id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $deptEmp = $this->DeptEmp->get($id);
        if ($this->DeptEmp->delete($deptEmp)) {
            $this->Flash->success(__('The dept emp has been deleted.'));
        } else {
            $this->Flash->error(__('The dept emp could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
