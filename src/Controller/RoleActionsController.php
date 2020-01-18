<?php

namespace MakvilleAcl\Controller;

use MakvilleAcl\Controller\AppController;

/**
 * RoleActions Controller
 *
 * @property \MakvilleAcl\Model\Table\RoleActionsTable $RoleActions
 */
class RoleActionsController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Roles', 'ModuleActions']
        ];
        $this->set('roleActions', $this->paginate($this->RoleActions));
        $this->set('_serialize', ['roleActions']);
    }

    /**
     * View method
     *
     * @param string|null $id Role Action id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $roleAction = $this->RoleActions->get($id, [
            'contain' => ['Roles', 'ModuleActions']
        ]);
        $this->set('roleAction', $roleAction);
        $this->set('_serialize', ['roleAction']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $roleAction = $this->RoleActions->newEmptyEntity();
        if ($this->request->is('post')) {
            $roleAction = $this->RoleActions->patchEntity($roleAction, $this->request->data);
            if ($this->RoleActions->save($roleAction)) {
                $this->Flash->success(__('The role action has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The role action could not be saved. Please, try again.'));
            }
        }
        $roles = $this->RoleActions->Roles->find('list', ['limit' => 200]);
        $moduleActions = $this->RoleActions->ModuleActions->find('list', ['limit' => 200]);
        $this->set(compact('roleAction', 'roles', 'moduleActions'));
        $this->set('_serialize', ['roleAction']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Role Action id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $roleAction = $this->RoleActions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $roleAction = $this->RoleActions->patchEntity($roleAction, $this->request->data);
            if ($this->RoleActions->save($roleAction)) {
                $this->Flash->success(__('The role action has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The role action could not be saved. Please, try again.'));
            }
        }
        $roles = $this->RoleActions->Roles->find('list', ['limit' => 200]);
        $moduleActions = $this->RoleActions->ModuleActions->find('list', ['limit' => 200]);
        $this->set(compact('roleAction', 'roles', 'moduleActions'));
        $this->set('_serialize', ['roleAction']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Role Action id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $roleAction = $this->RoleActions->get($id);
        if ($this->RoleActions->delete($roleAction)) {
            $this->Flash->success(__('The role action has been deleted.'));
        } else {
            $this->Flash->error(__('The role action could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

}
