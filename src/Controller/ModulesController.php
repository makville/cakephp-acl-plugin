<?php

namespace MakvilleAcl\Controller;

use MakvilleAcl\Controller\AppController;
use Cake\Utility\Inflector;
use DirectoryIterator;

/**
 * Modules Controller
 *
 * @property \MakvilleAcl\Model\Table\ModulesTable $Modules
 */
class ModulesController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('modules', $this->paginate($this->Modules));
        $this->set('_serialize', ['modules']);
    }

    /**
     * View method
     *
     * @param string|null $id Module id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $module = $this->Modules->get($id, [
            'contain' => ['ModuleActionGroups']
        ]);
        $this->set('module', $module);
        $this->set('_serialize', ['module']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $module = $this->Modules->newEmptyEntity();
        if ($this->request->is('post')) {
            $module = $this->Modules->patchEntity($module, $this->request->data);
            if ($this->Modules->save($module)) {
                $this->Flash->success(__('The module has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The module could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('module'));
        $this->set('_serialize', ['module']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Module id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $module = $this->Modules->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $module = $this->Modules->patchEntity($module, $this->request->data);
            if ($this->Modules->save($module)) {
                $this->Flash->success(__('The module has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The module could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('module'));
        $this->set('_serialize', ['module']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Module id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $module = $this->Modules->get($id);
        if ($this->Modules->delete($module)) {
            $this->Flash->success(__('The module has been deleted.'));
        } else {
            $this->Flash->error(__('The module could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function setup() {
        $signature = md5(sha1(mt_rand(100, 999) . '-' . date('Y-m-d H:i:s')));
        $skip = ['Element', 'Email', 'Error', 'Layout', 'Pages'];
        $modules = [];
        $moduleName = 'App';
        $mainPath = new DirectoryIterator(ROOT . '/src/Template');
        foreach ($mainPath as $sub) {
            if ($sub->isDir() && !$sub->isDot() && !in_array($sub->getFilename(), $skip)) {
                //process the content of this folder
                $groupName = $sub->getFilename();
                $groupIndex = Inflector::underscore($sub->getFilename());
                $subDir = new DirectoryIterator(ROOT . '/src/Template/' . $groupName);
                foreach ($subDir as $index => $f) {
                    if ($f->isFile()) {
                        if (!in_array($f->getFilename(), ['system', 'public'])) {
                            $fileName = Inflector::underscore(explode('.', $f->getFilename())[0]);
                            $modules[$moduleName][$groupIndex][$moduleName . '-' . $groupName . '-' . $fileName]['name'] = $fileName;
                            $modules[$moduleName][$groupIndex][$moduleName . '-' . $groupName . '-' . $fileName]['has_ownership'] = $this->Modules->ModuleActions->hasOwnershipCheck($f->getPathname());
                            $modules[$moduleName][$groupIndex][$moduleName . '-' . $groupName . '-' . $fileName]['is_system'] = $this->Modules->ModuleActions->isSystem($f->getPathname());
                            $modules[$moduleName][$groupIndex][$moduleName . '-' . $groupName . '-' . $fileName]['is_public'] = $this->Modules->ModuleActions->isPublic($f->getPathname());
                        }
                    }
                }
            }
        }
        $pluginPath = new DirectoryIterator(ROOT . '/plugins/');
        foreach ($pluginPath as $dir) {
            if ($dir->isDir() && !$dir->isDot()) {
                $moduleName = $dir->getFilename();
                //process the modules
                $modulePath = new DirectoryIterator(ROOT . '/plugins/' . $moduleName . '/src/Template/');
                if ( $this->Modules->isPublic(ROOT . '/plugins/' . $moduleName)) {
                    continue;
                }
                if ($this->Modules->isSystem(ROOT . '/plugins/' . $moduleName)) {
                    $moduleName .= '-system';
                }
                foreach ($modulePath as $group) {
                    if ($group->isDir() && !$group->isDot() && !in_array($group->getFilename(), $skip)) {
                        $groupName = $group->getFilename();
                        $groupIndex = Inflector::underscore($group->getFilename());
                        $cleanModuleName = $this->Modules->reformatName($moduleName);
                        $groupPath = new DirectoryIterator(ROOT . '/plugins/' . $cleanModuleName . '/src/Template/' . $groupName);
                        if ( $this->Modules->ModuleActionGroups->isPublic(ROOT . '/plugins/' . $cleanModuleName . '/src/Template/' . $groupName)) {
                            continue;
                        }
                        if ($this->Modules->ModuleActionGroups->isSystem(ROOT . '/plugins/' . $cleanModuleName . '/src/Template/' . $groupName)) {
                            $groupIndex .= '-system';
                        }
                        foreach ($groupPath as $index => $f) {
                            if ($f->isFile()) {
                                if (!in_array($f->getFilename(), ['system', 'public'])) {
                                    if ( $this->Modules->ModuleActions->isPublic($f->getPathname()) ) {
                                        continue;
                                    }
                                    $fileName = Inflector::underscore(explode('.', $f->getFilename())[0]);
                                    $modules[$moduleName][$groupIndex][$moduleName . '-' . $groupName . '-' . $fileName]['name'] = $fileName;
                                    $modules[$moduleName][$groupIndex][$moduleName . '-' . $groupName . '-' . $fileName]['has_ownership'] = $this->Modules->ModuleActions->hasOwnershipCheck($f->getPathname());
                                    $modules[$moduleName][$groupIndex][$moduleName . '-' . $groupName . '-' . $fileName]['is_system'] = $this->Modules->ModuleActions->isSystem($f->getPathname());
                                    $modules[$moduleName][$groupIndex][$moduleName . '-' . $groupName . '-' . $fileName]['is_public'] = $this->Modules->ModuleActions->isPublic($f->getPathname());
                                }
                            }
                        }
                    }
                }
            }
        }
        foreach ($modules as $module => $groups) {
            //save the module if it is new
            $moduleEntity = $this->Modules->saveModule($module, $signature);
            foreach ($groups as $group => $actions) {
                //save the group (i.e. controller) if it is new
                $groupEntity = $this->Modules->ModuleActionGroups->saveGroup($moduleEntity, $group, $signature);
                foreach ($actions as $action) {
                    //save the action (i.e the template) if it is new
                    if ($this->Modules->ModuleActions->isUnique($moduleEntity->id, $groupEntity->id, $action, $signature)) {
                        $isSystem = 0;
                        if ($action['is_system']) {
                            $isSystem = 1;
                        }
                        $hasOwnership = 0;
                        if ($action['has_ownership']) {
                            $hasOwnership = 1;
                        }
                        $isPublic = 0;
                        if ( $action['is_public'] ) {
                            $isPublic = 1;
                        }
                        $actionEntity = $this->Modules->ModuleActions->newEntity(['module_id' => $moduleEntity->id, 'module_action_group_id' => $groupEntity->id, 'name' => $action['name'], 'handle' => strtolower($moduleEntity->name . "." . $groupEntity->name . "." . $action['name']), 'ownership_check' => $hasOwnership, 'is_system' => $isSystem, 'is_public' => $isPublic, 'signature' => $signature]);
                        $this->Modules->ModuleActions->save($actionEntity);
                    }
                }
            }
        }
        //purge
        $this->Modules->purge($signature);
        $this->Modules->ModuleActionGroups->purge($signature);
        $this->Modules->ModuleActions->purge($signature);
    }
}
