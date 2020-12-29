<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Assign Controller
 *
 * @property \App\Model\Table\AssignTable $Assign
 * @method \App\Model\Entity\Assign[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AssignController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event) {
        parent::beforeFilter($event);
        // pour tous les contrôleurs de notre application, rendre les actions
        // index et view publiques, en ignorant la vérification d'authentification
        $this->Authentication->addUnauthenticatedActions(['apply']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $assign = $this->paginate($this->Assign);

        $this->set(compact('assign'));
    }

    /**
     * View method
     *
     * @param string|null $id Assign id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assign = $this->Assign->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('assign'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $assign = $this->Assign->newEmptyEntity();
        if ($this->request->is('post')) {
            $assign = $this->Assign->patchEntity($assign, $this->request->getData());
            if ($this->Assign->save($assign)) {
                $this->Flash->success(__('The assign has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The assign could not be saved. Please, try again.'));
        }
        $this->set(compact('assign'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Assign id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assign = $this->Assign->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assign = $this->Assign->patchEntity($assign, $this->request->getData());
            if ($this->Assign->save($assign)) {
                $this->Flash->success(__('The assign has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The assign could not be saved. Please, try again.'));
        }
        $this->set(compact('assign'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Assign id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $assign = $this->Assign->get($id);
        if ($this->Assign->delete($assign)) {
            $this->Flash->success(__('The assign has been deleted.'));
        } else {
            $this->Flash->error(__('The assign could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Apply for a job
     * 
     * @param string $dept_no Department'id
     * @return \Cake\Http\Response|null|void Redirects to apply.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function apply(string $dept_no, string $title_no) {
        $assign = $this->Assign->newEmptyEntity();

        if ($this->request->is('post')) {
            $datas = $this->request->getData();
            $file = $datas['cv'];
            
            $datas['dept_no'] = $dept_no;
            $datas['title_no'] = $title_no;
            $datas['cv'] = $file->getClientFilename();

            $assign = $this->Assign->patchEntity($assign, $datas);

            if ($file->getSize() > 500000) {
                $this->Flash->error(__("The file's size is too big !"));
            } elseif ($file->getClientMediaType() != "application/pdf") {
                $this->Flash->error(__("The file's type isn't valid !"));
            } else {
                $destination = WWW_ROOT . DS . 'cv' . DS . $file->getClientFilename();

                $file->moveTo($destination);
            }

            if ($this->Assign->save($assign)) {
                $this->Flash->success(__("You've just assigned for a job !"));

                return $this->redirect(['controller' => 'departments', 'action' => 'index']);
            }

            $this->Flash->error(__("You can't assign for a job right now. Come back later !"));
        }

        $this->set(compact('assign'));
    }
}
