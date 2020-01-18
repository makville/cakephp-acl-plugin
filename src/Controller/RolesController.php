<?php

namespace MakvilleAcl\Controller;

use MakvilleAcl\Controller\AppController;

/**
 * Roles Controller
 *
 * @property \MakvilleAcl\Model\Table\RolesTable $Roles
 */
class RolesController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('roles', $this->paginate($this->Roles));
        $this->set('_serialize', ['roles']);
    }

    /**
     * View method
     *
     * @param string|null $id Role id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $role = $this->Roles->get($id, [
            'contain' => ['RoleActions', 'UserRoles']
        ]);
        $this->set('role', $role);
        $this->set('_serialize', ['role']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $role = $this->Roles->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->data['roles'];
            $role = $this->Roles->patchEntity($role, $data);
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The role could not be saved. Please, try again.'));
            }
        }
        $moduleActionStructure = $this->Roles->RoleActions->ModuleActions->Modules->getModuleActionStructure();
        $isSystemUser = $this->Auth->user('is_system');
        $this->set(compact('role', 'moduleActionStructure', 'isSystemUser'));
        $this->set('_serialize', ['role']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Role id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $role = $this->Roles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data['roles'];
            $role = $this->Roles->patchEntity($role, $data);
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The role could not be saved. Please, try again.'));
            }
        }
        $rolePrivileges = $this->Roles->getRolePrivileges($id);
        $moduleActionStructure = $this->Roles->RoleActions->ModuleActions->Modules->getModuleActionStructure();
        $isSystemUser = $this->Auth->user('is_system');
        $this->set(compact('role', 'moduleActionStructure', 'isSystemUser', 'rolePrivileges'));
        $this->set('_serialize', ['role']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Role id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $role = $this->Roles->get($id);
        if ($this->Roles->delete($role)) {
            $this->Flash->success(__('The role has been deleted.'));
        } else {
            $this->Flash->error(__('The role could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

}
