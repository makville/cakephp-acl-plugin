<?php

declare(strict_types = 1);

namespace MakvilleAcl\Controller;

/**
 * Roles Controller
 *
 * @property \MakvilleAcl\Model\Table\RolesTable $Roles
 *
 * @method \MakvilleAcl\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RolesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index() {
        $roles = $this->paginate($this->Roles);

        $this->set(compact('roles'));
    }

    /**
     * View method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $role = $this->Roles->get($id, [
            'contain' => [],
        ]);
        $users = $this->Roles->UserRoles->Users->find('all');
        $modules = $this->Roles->RoleActions->ModuleActions->Modules->find('all')->contain(['Duties' => ['ModuleActions']]);
        $roleUsers = $this->Roles->UserRoles->find('list', ['valueField' => 'user_id'])->where(['role_id' => $id])->toArray();
        $roleActions = array_unique($this->Roles->RoleActions->find('list', ['valueField' => 'module_action_id'])->where(['role_id' => $id])->toArray());
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $assigner = $this->Authentication->getIdentity();
            if (isset($data['membership'])) {
                if (isset($data['members'])) {
                    $unAssign = array_diff($roleUsers, $data['members']);
                    foreach ($data['members'] as $userId) {
                        if ($this->Roles->assignMember($id, $userId, $assigner->id)) {
                            $roleUsers[] = $userId;
                        }
                    }
                } else {
                    $data['members'] = [];
                }
                foreach ($unAssign as $userId) {
                    if ($this->Roles->unAssignMember($id, $userId)) {
                        $key = array_search($userId, $roleUsers);
                        if ($key !== false) {
                            unset($roleUsers[$key]);
                        }
                    }
                }
            }
            if (isset($data['duties'])) {
                $actions = [];
                if (isset($data['actions'])) {
                    foreach ($data['actions'] as $dutyId) {
                        $duty = $this->Roles->RoleActions->ModuleActions->Duties->get($dutyId, ['contain' => ['ModuleActions']]);
                        foreach ($duty->module_actions as $action) {
                            $actions[] = $action->id;
                            if ($this->Roles->assignDuty($id, $action->id, $assigner->id)) {
                                $roleActions[] = $action->id;
                            }
                        }
                    }
                } else {
                    $data['actions'] = [];
                }
                $unAssign = array_diff($roleActions, $actions);
                foreach ($unAssign as $moduleActionId) {
                    if ($this->Roles->unAssignDuty($id, $moduleActionId)) {
                        $key = array_search($moduleActionId, $roleActions);
                        if ($key !== false) {
                            unset($roleActions[$key]);
                        }
                    }
                }
            }
        }
        $this->set(compact('role', 'users', 'modules', 'roleActions', 'roleUsers'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $role = $this->Roles->newEmptyEntity();
        if ($this->request->is('post')) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The role could not be saved. Please, try again.'));
        }
        $this->set(compact('role'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $role = $this->Roles->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The role could not be saved. Please, try again.'));
        }
        $this->set(compact('role'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
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
