<?php

declare(strict_types = 1);

namespace MakvilleAcl\Controller;

use Cake\Core\Configure;

/**
 * Users Controller
 *
 * @property \MakvilleAcl\Model\Table\UsersTable $Users
 *
 * @method \MakvilleAcl\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index() {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $user = $this->Users->get($id, [
            'contain' => ['UserProfiles']
        ]);
        $profileFields = $this->Users->UserProfiles->UserProfileFields->find('list')->toArray();
        $roles = $this->Users->UserRoles->Roles->find('all');
        $userRoles = $this->Users->UserRoles->find('list', ['valueField' => 'role_id'])->where(['user_id' => $id])->toArray();
        if ($this->request->is('post')) {
            $assigner = $this->Authentication->getIdentity();
            $data = $this->request->getData();
            if (isset($data['roles'])) {
                foreach ($data['roles'] as $roleId) {
                    if ($this->Users->UserRoles->Roles->assignMember($roleId, $id, $assigner->id)) {
                        $userRoles[] = $roleId;
                    }
                }
            } else {
                $data['roles'] = [];
            }
            $unAssign = array_diff($userRoles, $data['roles']);
            foreach ($unAssign as $roleId) {
                if ($this->Users->UserRoles->Roles->unAssignMember($roleId, $id)) {
                    $key = array_search($roleId, $userRoles);
                    if ($key !== false) {
                        unset($userRoles[$key]);
                    }
                }
            }
            $this->Flash->success('User updated');
        }
        $this->set(compact('user', 'profileFields', 'roles', 'userRoles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $user = $this->Users->get($id, [
            'contain' => ['UserProfiles', 'UserRoles'],
        ]);
        $roles = $this->Users->UserRoles->Roles->find('all');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user', 'roles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function signup() {
        $this->viewBuilder()->setLayout('default');
        $user = $this->Users->newEmptyEntity();
        $profileFields = $this->Users->UserProfiles->UserProfileFields->find('all');
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if ($data['password'] != '' && $data['password'] == $data['confirm_password']) {
                $user = $this->Users->patchEntity($user, $data, ['associated' => ['UserProfiles']]);
                $user->status = 'inactive';
                $user->expiring = (new \Cake\Chronos\Chronos())->add(new \DateInterval("PT1H"));
                $user->code = $this->Users->generateActivationToken();
                if ($this->Users->save($user)) {
                    //user has now been saved
                    $this->Flash->success('Your account has been registered. An email has been sent to you with an activation link to activate your account');
                    //send the new_account email
                    $link = \Cake\Routing\Router::url(['plugin' => 'MakvilleAcl', 'controller' => 'Users', 'action' => 'activate', $user->email, $user->code]);
                    $host = $this->request->getAttribute('webroot');
                    $message = $this->Acl->loadEmailMessage('new-account', $host, $user->email, $link, $host);
                    $this->Mailgun->send(Configure::read('makville-acl-account-email-address'), $user->email, 'Account created', $message);
                    return $this->redirect(['action' => 'notify', 'new-account']);
                }
            } else {
                $this->Flash->error('Invalid password or password mismatch error. Please ensure you have entered a password and that both passwords match.');
            }
        }
        $this->set(compact('user', 'profileFields'));
    }

    public function invite() {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $user = $this->Users->patchEntity($user, $data);
            $user->status = 'inactive';
            $user->expiring = (new \Cake\Chronos\Chronos())->add(new \DateInterval("PT1H"));
            $user->code = $this->Users->generateActivationToken();
            if ($this->Users->save($user)) {
                //user has now been saved
                $this->Flash->success('An account has been created and an invitation sent to the email with further activation instructions');
                //send the new_account email
                $link = \Cake\Routing\Router::url(['plugin' => 'MakvilleAcl', 'controller' => 'Users', 'action' => 'reset', $user->email, $user->code]);
                $host = $this->request->getAttribute('webroot');
                $message = $this->Acl->loadEmailMessage('new-invitation', $host, $user->email, $link, $host);
                $this->Mailgun->send(Configure::read('makville-acl-account-email-address'), $user->email, 'Account created', $message);
                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('user'));
    }

    public function activate($email, $code) {
        if ($this->Users->isValidCode($email, $code)) {
            if (Configure::read('makville-acl-require-moderation')) {
                $user = $this->Users->getUserByEmail($email);
                $user->expiring = (new \Cake\Chronos\Chronos())->add(new \DateInterval("P2D"));
                $user->code = $this->Users->generateActivationToken();
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('Your account have been activate. It is however awaiting approval by a moderator'));
                    //send the new_account email
                    $link = \Cake\Routing\Router::url(['plugin' => 'MakvilleAcl', 'controller' => 'Users', 'action' => 'approve', $user->email, $user->code]);
                    $host = $this->request->getAttribute('webroot');
                    $message = $this->Acl->loadEmailMessage('request-moderation', $host, $user->email, $link, $host);
                    $this->Mailgun->send(Configure::read('makville-acl-account-email-address'), $user->email, 'Your account is awaiting moderation', $message);
                    return $this->redirect(['action' => 'notify', 'request-moderation']);
                }
            } else {
                if ($this->Users->activate($email)) {
                    $this->Flash->success(__('Your account has been activated'));
                    return $this->redirect(['action' => 'login']);
                }
            }
        }
        $this->Flash->error(__('Account activation failed'));
        return $this->redirect(['action' => 'notify', 'activation-failed']);
    }

    public function deactivate($email) {
        if ($this->Users->deactivate($email)) {
            $this->Flash->success('Account deactivated');
        } else {
            $this->Flash->error('Account deactivation failed');
        }
        return $this->redirect(['action' => 'index']);
    }

    public function approve($email, $code) {
        $user = $this->Users->getUserByEmail($email);
        $profileFields = $this->Users->UserProfiles->UserProfileFields->find('list')->toArray();
        if ($this->request->is('post')) {
            if ($this->Users->isValidCode($email, $code)) {
                if ($this->Users->activate($email)) {
                    $this->Flash->success("Account approved successfully");
                    //notify the user of approval of account
                    $link = \Cake\Routing\Router::url(['plugin' => 'MakvilleAcl', 'controller' => 'Users', 'action' => 'login']);
                    $host = $this->request->getAttribute('webroot');
                    $message = $this->Acl->loadEmailMessage('account-approved', $host, $user->email, $link, $host);
                    $this->Mailgun->send(Configure::read('makville-acl-account-email-address'), $user->email, 'Your account has been approved', $message);
                }
            } else {
                $this->Flash->error("Account approval failed");
            }
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('email', 'code', 'user', 'profileFields'));
    }

    public function login() {
        $this->viewBuilder()->setLayout('default');
        if ($this->request->is('post')) {
            if ($this->Users->isActivated($this->request->getData('email'))) {
                $result = $this->Authentication->getResult();
                // If the user is logged in send them away.
                if ($result->isValid()) {
                    $user = $result->getData();
                    if (Configure::read('makville-acl-require-2fa')) {
                        //generate 2f and send via email
                        $this->Auth2fa->send2f($user);
                        return $this->redirect(['action' => 'token2fa', $user->email]);
                    } else {
                        //load this user's role structure and keep it in the session
                        $this->Acl->loadRoles($result->getData());
                        $target = $this->Authentication->getLoginRedirect() ?? ['plugin' => 'MakvilleControlPanel', 'controller' => 'Admin', 'action' => 'dashboard'];
                        return $this->redirect($target);
                    }
                }
            }
            $this->Flash->error('The user identity or password you entered is not valid. Its also possible your account is not yet active');
        } else {
            $this->Authentication->logout();
        }
    }

    public function logout() {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }

    public function token2fa($email) {
        $this->viewBuilder()->setLayout('default');
        if ($this->request->is('post')) {
            $user = $this->Users->getUserByEmail($this->request->getData('email'));
            if (empty($this->request->getData('token'))) {
                $this->Auth2fa->send2f($user);
            } else {
                if ($this->Auth2fa->verify2f($user, $this->request->getData('token'))) {
                    $this->Acl->loadRoles($user);
                    $target = $this->Authentication->getLoginRedirect() ?? ['plugin' => 'MakvilleControlPanel', 'controller' => 'Admin', 'action' => 'dashboard'];
                    return $this->redirect($target);
                }
                $this->Flash->error('Token verification failed');
            }
        }
        $this->set(compact('email'));
    }

    public function recover() {
        $this->viewBuilder()->setLayout('default');
        if ($this->request->is('post')) {
            if ($this->Users->isValidEmail($this->request->getData('email'))) {
                $user = $this->Users->getUserByEmail($this->request->getData('email'));
                $user->code = $this->Users->generateActivationToken();
                $user->expiring = (new \Cake\Chronos\Chronos())->add(new \DateInterval("PT1H"));
                if ($this->Users->save($user)) {
                    $link = \Cake\Routing\Router::url(['plugin' => 'MakvilleAcl', 'controller' => 'Users', 'action' => 'reset', $user->email, $user->code]);
                    $host = $this->request->getAttribute('webroot');
                    $message = $this->Acl->loadEmailMessage('recovery', $host, $user->email, $link, $host);
                    $this->Mailgun->send(Configure::read('makville-acl-account-email-address'), $user->email, 'Account recovery', $message);
                }
            }
            return $this->redirect(['action' => 'notify', 'recovery']);
        }
    }

    public function reset($email, $code) {
        $this->viewBuilder()->setLayout('default');
        if ($this->Users->isValidCode($email, $code)) {
            if ($this->request->is('post')) {
                $data = $this->request->getData();
                if ($data['password'] != '' && $data['password'] == $data['confirm_password']) {
                    $user = $this->Users->getUserByEmail($email);
                    $user->password = $data['password'];
                    if ($this->Users->save($user)) {
                        $this->Users->activate($user->email);
                        $this->Flash->success('Password set successfully');
                        return $this->redirect(['action' => 'login']);
                    }
                } else {
                    $this->Flash->error('Invalid password or password mismatch error. Please ensure you have entered a password and that both passwords match.');
                }
            }
        } else {
            $this->Flash->error('Invalid or expired account recovery request');
            return $this->redirect(['action' => 'login']);
        }
        $this->set(compact('email'));
    }

    public function changePassword() {
        $user = $this->Authentication->getIdentity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if ($data['new_password'] != '' && $data['new_password'] == $data['confirm_new_password']) {
                $result = $this->Authentication->getResult();
                if ($result->isValid()) {
                    $user = $this->Users->getUserByEmail($data['email']);
                    $user->password = $data['new_password'];
                    if ($this->Users->save($user)) {
                        $this->Flash->success('Password changed');
                        return $this->redirect(['action' => 'login']);
                    }
                } else {
                    $this->Flash->error('Authentication failed');
                }
            } else {
                $this->Flash->error('Invalid password or password mismatch error. Please ensure you have entered a password and that both passwords match.');
            }
        }
        $this->set(compact('user'));
    }

    public function editProfile() {
        $user = $this->Users->getUserByEmail($this->Authentication->getIdentity()->email);
        $profileFields = $this->Users->UserProfiles->UserProfileFields->find('all');
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData(), ['associated' => ['UserProfiles']]);
            $this->Users->save($user);
        }
        $userProfile = $this->Users->getUserProfile($user->email, true);
        $this->set(compact('user', 'userProfile', 'profileFields'));
    }

    public function notify($event) {
        $this->viewBuilder()->setLayout('default');
        $this->set(compact('event'));
    }

    public function pay () {
        $this->Flutterwave->pay('ayomakanjuola@gmail.com', '5', 'NGN');
        exit();
    }
    
    public function paid () {
        $this->Flutterwave->paid();
        exit();
    }
    
    public function charge() {
        $this->Flutterwave->charge('ayomakanjuola@gmail.com', '7', 'NGN');
        exit();
    }
}
