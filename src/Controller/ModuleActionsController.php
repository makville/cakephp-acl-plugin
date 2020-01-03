<?php

namespace MakvilleAcl\Controller;

use MakvilleAcl\Controller\AppController;;

/**
 * ModuleActions Controller
 *
 * @property \MakvilleAcl\Model\Table\ModuleActionsTable $ModuleActions
 */
class ModuleActionsController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->paginate = [
            'contain' => ['ModuleActionGroups']
        ];
        $this->set('moduleActions', $this->paginate($this->ModuleActions));
        $this->set('_serialize', ['moduleActions']);
    }

    /**
     * View method
     *
     * @param string|null $id Module Action id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $moduleAction = $this->ModuleActions->get($id, [
            'contain' => ['ModuleActionGroups', 'RoleActions']
        ]);
        $this->set('moduleAction', $moduleAction);
        $this->set('_serialize', ['moduleAction']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $moduleAction = $this->ModuleActions->newEntity();
        if ($this->request->is('post')) {
            $moduleAction = $this->ModuleActions->patchEntity($moduleAction, $this->request->data);
            if ($this->ModuleActions->save($moduleAction)) {
                $this->Flash->success(__('The module action has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The module action could not be saved. Please, try again.'));
            }
        }
        $moduleActionGroups = $this->ModuleActions->ModuleActionGroups->find('list', ['limit' => 200]);
        $this->set(compact('moduleAction', 'moduleActionGroups'));
        $this->set('_serialize', ['moduleAction']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Module Action id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $moduleAction = $this->ModuleActions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $moduleAction = $this->ModuleActions->patchEntity($moduleAction, $this->request->data);
            if ($this->ModuleActions->save($moduleAction)) {
                $this->Flash->success(__('The module action has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The module action could not be saved. Please, try again.'));
            }
        }
        $moduleActionGroups = $this->ModuleActions->ModuleActionGroups->find('list', ['limit' => 200]);
        $this->set(compact('moduleAction', 'moduleActionGroups'));
        $this->set('_serialize', ['moduleAction']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Module Action id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $moduleAction = $this->ModuleActions->get($id);
        if ($this->ModuleActions->delete($moduleAction)) {
            $this->Flash->success(__('The module action has been deleted.'));
        } else {
            $this->Flash->error(__('The module action could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

}
