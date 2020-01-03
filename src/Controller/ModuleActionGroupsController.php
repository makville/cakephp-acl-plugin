<?php

namespace MakvilleAcl\Controller;

use MakvilleAcl\Controller\AppController;

/**
 * ModuleActionGroups Controller
 *
 * @property \MakvilleAcl\Model\Table\ModuleActionGroupsTable $ModuleActionGroups
 */
class ModuleActionGroupsController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Modules']
        ];
        $this->set('moduleActionGroups', $this->paginate($this->ModuleActionGroups));
        $this->set('_serialize', ['moduleActionGroups']);
    }

    /**
     * View method
     *
     * @param string|null $id Module Action Group id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $moduleActionGroup = $this->ModuleActionGroups->get($id, [
            'contain' => ['Modules', 'ModuleActions']
        ]);
        $this->set('moduleActionGroup', $moduleActionGroup);
        $this->set('_serialize', ['moduleActionGroup']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $moduleActionGroup = $this->ModuleActionGroups->newEntity();
        if ($this->request->is('post')) {
            $moduleActionGroup = $this->ModuleActionGroups->patchEntity($moduleActionGroup, $this->request->data);
            if ($this->ModuleActionGroups->save($moduleActionGroup)) {
                $this->Flash->success(__('The module action group has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The module action group could not be saved. Please, try again.'));
            }
        }
        $modules = $this->ModuleActionGroups->Modules->find('list', ['limit' => 200]);
        $this->set(compact('moduleActionGroup', 'modules'));
        $this->set('_serialize', ['moduleActionGroup']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Module Action Group id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $moduleActionGroup = $this->ModuleActionGroups->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $moduleActionGroup = $this->ModuleActionGroups->patchEntity($moduleActionGroup, $this->request->data);
            if ($this->ModuleActionGroups->save($moduleActionGroup)) {
                $this->Flash->success(__('The module action group has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The module action group could not be saved. Please, try again.'));
            }
        }
        $modules = $this->ModuleActionGroups->Modules->find('list', ['limit' => 200]);
        $this->set(compact('moduleActionGroup', 'modules'));
        $this->set('_serialize', ['moduleActionGroup']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Module Action Group id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $moduleActionGroup = $this->ModuleActionGroups->get($id);
        if ($this->ModuleActionGroups->delete($moduleActionGroup)) {
            $this->Flash->success(__('The module action group has been deleted.'));
        } else {
            $this->Flash->error(__('The module action group could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

}
