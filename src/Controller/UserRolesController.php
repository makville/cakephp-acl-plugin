<?php

namespace Acl\Controller;

use Acl\Controller\AppController;

/**
 * UserRoles Controller
 *
 * @property \Acl\Model\Table\AclUserRolesTable $UserRoles
 */
class UserRolesController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Users', 'Roles']
        ];
        $this->set('userRoles', $this->paginate($this->UserRoles));
        $this->set('_serialize', ['userRoles']);
    }

    /**
     * View method
     *
     * @param string|null $id Acl User Role id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $userRole = $this->UserRoles->get($id, [
            'contain' => ['Users', 'Roles']
        ]);
        $this->set('userRole', $userRole);
        $this->set('_serialize', ['userRole']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $userRole = $this->UserRoles->newEntity();
        if ($this->request->is('post')) {
            $userRole = $this->UserRoles->patchEntity($userRole, $this->request->data);
            if ($this->UserRoles->save($userRole)) {
                $this->Flash->success(__('The user role has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user role could not be saved. Please, try again.'));
            }
        }
        $users = $this->UserRoles->Users->find('list', ['limit' => 200]);
        $roles = $this->UserRoles->Roles->find('list', ['limit' => 200]);
        $this->set(compact('userRole', 'users', 'roles'));
        $this->set('_serialize', ['userRole']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Acl User Role id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $userRole = $this->UserRoles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userRole = $this->UserRoles->patchEntity($userRole, $this->request->data);
            if ($this->UserRoles->save($userRole)) {
                $this->Flash->success(__('The user role has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user role could not be saved. Please, try again.'));
            }
        }
        $users = $this->UserRoles->Users->find('list', ['limit' => 200]);
        $roles = $this->UserRoles->Roles->find('list', ['limit' => 200]);
        $this->set(compact('userRole', 'users', 'roles'));
        $this->set('_serialize', ['userRole']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Acl User Role id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $userRole = $this->UserRoles->get($id);
        if ($this->UserRoles->delete($userRole)) {
            $this->Flash->success(__('The user role has been deleted.'));
        } else {
            $this->Flash->error(__('The user role could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function priviledges() {
        $user = $this->UserRoles->Users->get($this->Auth->user('id'));
        if ($this->request->is('post')) {
            //purge current user priviledges
            $this->UserRoles->purgeUsersRoles($user->id);
            foreach ($this->request->data['user_roles'] as $userRole) {
                if (isset($userRole['role_id']) && is_numeric($userRole['role_id']) && $userRole['role_id'] > 0) {
                    $userRoleEntity = $this->UserRoles->newEntity($userRole);
                    $userRoleEntity->assigned_by = $this->Auth->user('id');
                    $this->UserRoles->save($userRoleEntity);
                }
            }
        }
        //get the current priviledges
        $userRoles = $this->UserRoles->getUsersRoles($user->id, true);
        $roles = $this->UserRoles->Roles->find();
        $this->set(compact('roles', 'user', 'userRoles'));
    }
}
