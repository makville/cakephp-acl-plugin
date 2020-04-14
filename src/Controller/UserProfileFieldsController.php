<?php
declare(strict_types=1);

namespace MakvilleAcl\Controller;

/**
 * UserProfileFields Controller
 *
 * @property \MakvilleAcl\Model\Table\UserProfileFieldsTable $UserProfileFields
 *
 * @method \MakvilleAcl\Model\Entity\UserProfileField[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UserProfileFieldsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $userProfileFields = $this->paginate($this->UserProfileFields);

        $this->set(compact('userProfileFields'));
    }

    /**
     * View method
     *
     * @param string|null $id User Profile Field id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userProfileField = $this->UserProfileFields->get($id, [
            'contain' => ['UserProfiles'],
        ]);

        $this->set('userProfileField', $userProfileField);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userProfileField = $this->UserProfileFields->newEmptyEntity();
        if ($this->request->is('post')) {
            $userProfileField = $this->UserProfileFields->patchEntity($userProfileField, $this->request->getData());
            if ($this->UserProfileFields->save($userProfileField)) {
                $this->Flash->success(__('The user profile field has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user profile field could not be saved. Please, try again.'));
        }
        $this->set(compact('userProfileField'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User Profile Field id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userProfileField = $this->UserProfileFields->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userProfileField = $this->UserProfileFields->patchEntity($userProfileField, $this->request->getData());
            if ($this->UserProfileFields->save($userProfileField)) {
                $this->Flash->success(__('The user profile field has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user profile field could not be saved. Please, try again.'));
        }
        $this->set(compact('userProfileField'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User Profile Field id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userProfileField = $this->UserProfileFields->get($id);
        if ($this->UserProfileFields->delete($userProfileField)) {
            $this->Flash->success(__('The user profile field has been deleted.'));
        } else {
            $this->Flash->error(__('The user profile field could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
