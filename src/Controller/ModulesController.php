<?php

declare(strict_types = 1);

namespace MakvilleAcl\Controller;

/**
 * Modules Controller
 *
 * @property \MakvilleAcl\Model\Table\ModulesTable $Modules
 *
 * @method \MakvilleAcl\Model\Entity\Module[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ModulesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index() {
        $modules = $this->Modules->find('all');

        $this->set(compact('modules'));
    }

    /**
     * View method
     *
     * @param string|null $id Module id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $module = $this->Modules->get($id, [
            'contain' => ['ModuleActionGroups', 'ModuleActions'],
        ]);

        $this->set('module', $module);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $module = $this->Modules->newEmptyEntity();
        if ($this->request->is('post')) {
            $module = $this->Modules->patchEntity($module, $this->request->getData());
            if ($this->Modules->save($module)) {
                $this->Flash->success(__('The module has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The module could not be saved. Please, try again.'));
        }
        $this->set(compact('module'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Module id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $module = $this->Modules->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $module = $this->Modules->patchEntity($module, $this->request->getData());
            if ($this->Modules->save($module)) {
                $this->Flash->success(__('The module has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The module could not be saved. Please, try again.'));
        }
        $this->set(compact('module'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Module id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        if ($this->Modules->remove($id)) {
            $this->Flash->success(__('The module has been deleted.'));
        } else {
            $this->Flash->error(__('The module could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function setup($name) {
        $configuration = json_decode(file_get_contents(\Cake\Core\Plugin::configPath($name) . "/duties.json"), true);
        if (!array_key_exists('name', $configuration)) {
            
        }
        if (!array_key_exists('version', $configuration)) {
            
        }
        if (!array_key_exists('description', $configuration)) {
            
        }
        if (!array_key_exists('duties', $configuration)) {
            
        }
        $this->Modules->configure($configuration);
        $this->set(compact('name'));
    }

    public function details($id) {
        $module = $this->Modules->get($id, ['contain' => ['Duties' => ['ModuleActions']]]);
        $this->set(compact('module'));
    }

    public function readme($name) {
        $this->set(compact('name'));
    }

    public function configure ($name) {
        
    }
}
