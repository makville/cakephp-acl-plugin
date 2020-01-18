<?php

namespace MakvilleAcl\Controller;

use MakvilleAcl\Controller\AppController;

/**
 * UserProfiles Controller
 *
 * @property \MakvilleAcl\Model\Table\UserProfilesTable $UserProfiles
 */
class UserProfilesController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $this->set('userProfiles', $this->paginate($this->UserProfiles));
        $this->set('_serialize', ['userProfiles']);
    }

    /**
     * View method
     *
     * @param string|null $id User Profile id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $userProfile = $this->UserProfiles->get($id, [
            'contain' => ['Users']
        ]);
        $this->set('userProfile', $userProfile);
        $this->set('_serialize', ['userProfile']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $userProfile = $this->UserProfiles->newEmptyEntity();
        if ($this->request->is('post')) {
            $userProfile = $this->UserProfiles->patchEntity($userProfile, $this->request->data);
            if ($this->UserProfiles->save($userProfile)) {
                $this->Flash->success(__('The user profile has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user profile could not be saved. Please, try again.'));
            }
        }
        $users = $this->UserProfiles->Users->find('list', ['limit' => 200]);
        $this->set(compact('userProfile', 'users'));
        $this->set('_serialize', ['userProfile']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Profile id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit() {
        //we will get the user id from the session
        $userId = $this->Auth->user()['id'];
        //does the user have an existing profile
        if (!$this->UserProfiles->userHasProfile($userId)) {
            //create a blank profile for the user to edit
            if (!$this->UserProfiles->createProfile($userId)) {
                //profile could not be created
            }
        }
        $userProfile = $this->UserProfiles->getUserProfile($userId);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userProfile = $this->UserProfiles->patchEntity($userProfile, $this->request->data);
            if ($this->UserProfiles->save($userProfile)) {
                $this->Flash->success(__('Your profile has been updated.'));
                return $this->redirect(['controller' => 'users', 'action' => 'dashboard']);
            } else {
                $this->Flash->error(__('Your profile was not updated. Please, try again.'));
            }
        }
        $this->set(compact('userProfile'));
        $this->set('_serialize', ['userProfile']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Profile id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $userProfile = $this->UserProfiles->get($id);
        if ($this->UserProfiles->delete($userProfile)) {
            $this->Flash->success(__('The user profile has been deleted.'));
        } else {
            $this->Flash->error(__('The user profile could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

}
