<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * DeptManager Controller
 *
 * @property \App\Model\Table\DeptManagerTable $DeptManager
 * @method \App\Model\Entity\DeptManager[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DeptManagerController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $deptManager = $this->paginate($this->DeptManager);

        $this->set(compact('deptManager'));
    }

    /**
     * View method
     *
     * @param string|null $id Dept Manager id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $deptManager = $this->DeptManager->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('deptManager'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $deptManager = $this->DeptManager->newEmptyEntity();
        if ($this->request->is('post')) {
            $deptManager = $this->DeptManager->patchEntity($deptManager, $this->request->getData());
            if ($this->DeptManager->save($deptManager)) {
                $this->Flash->success(__('The dept manager has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dept manager could not be saved. Please, try again.'));
        }
        $this->set(compact('deptManager'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Dept Manager id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $deptManager = $this->DeptManager->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $deptManager = $this->DeptManager->patchEntity($deptManager, $this->request->getData());
            if ($this->DeptManager->save($deptManager)) {
                $this->Flash->success(__('The dept manager has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dept manager could not be saved. Please, try again.'));
        }
        $this->set(compact('deptManager'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Dept Manager id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $deptManager = $this->DeptManager->get($id);
        if ($this->DeptManager->delete($deptManager)) {
            $this->Flash->success(__('The dept manager has been deleted.'));
        } else {
            $this->Flash->error(__('The dept manager could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Revoque un manager
     *
     * @param string $emp_no Le numéro d'employé du manager.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function revoke(string $emp_no) {
        $this->request->allowMethod(['post', 'delete']);

        $query = $this->DeptManager->query();

        $result = $query->update()
            ->set(['to_date' => date('Y-m-d')])
            ->where(['emp_no' => $emp_no])
            ->execute();

        if ($result) {
            $this->Flash->success(__('The manager has been revoked'));
        } else {
            $this->Flash->error(__("The manager can't be revoked, try again later"));
        }

        return $this->redirect(['controller' => 'departments','action' => 'index']);
    }
}
