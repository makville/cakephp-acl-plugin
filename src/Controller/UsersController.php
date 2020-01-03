<?php

namespace Acl\Controller;

use Acl\Controller\AppController;
use Carbon\Carbon;
use Cake\ORM\TableRegistry;

/**
 * AclUsers Controller
 *
 * @property \Acl\Model\Table\UsersTable $Users
 */
class UsersController extends AppController {

    public $registrationUrl = 'http://www.parkinsonnigeria.com/';
    public $registrationMail = 'no-reply@parkinsonnigeria.com';
    public $registrationTitle = 'Your account has been registered. Kindly confirm your account';
    public $resetTitle = 'Your password/token has been reset';

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('users', $this->paginate($this->Users->find()
                                ->contain(['UserProfiles'])
                                ->where(['status' => 'active'])
                                ->andWhere(['role' => 'approved'])
                )
        );
        $this->set('_serialize', ['users']);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function requests() {
        $this->set('users', $this->paginate($this->Users->find()
                                ->contain(['UserProfiles'])
                                ->where(['status' => 'active'])
                                ->andWhere([function ($exp) {
                                        return $exp->notEq('role', 'approved', 'string');
                                    }])
                )
        );
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $user = $this->Users->get($id, [
            'contain' => ['UserRoles' => ['Roles']]
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function signup() {
        $this->viewBuilder()->layout('default');
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            if ($this->Captcha->isValid()) {
                $data = $this->request->data();
                $data['name'] = $data['surname'] . ' ' . $data['othernames'];
                $data['user_profile'] = [
                    'name' => $data['name'],
                    'institution' => $data['institution'],
                    'country' => 'Nigeria',
                    'specialty' => $data['specialty'],
                    'specialty_others' => $data['specialty_others']
                ];
                $user = $this->Users->patchEntity($user, $data);
                $user->username = $user->email;
                $user->status = 'inactive';
                $user->role = 'pending';
                $user->code = $this->Users->generateToken();
                $expiry = new Carbon(null, 'Africa/Lagos');
                $expiry->addDays(1);
                $user->expiring = $expiry;
                if ($this->Users->save($user)) {
                    //create a blank profile
                    $this->Users->UserProfiles->createProfile($user->id);
                    //send an email to the user containing the activation message
                    $message = sprintf('You have been registered with %s at Nigeria Parkinson Disease Registry. Click the following link to confirm your registration. Your account still needs to be approved by the administrator before it becomes active. ', $user->email);
                    $message .= $this->registrationUrl . 'acl/users/activate/' . $user->email . '/' . $user->code;
                    $this->Mailgun->send($this->registrationMail, $user->email, $this->registrationTitle, $message);
                    $this->Flash->success(__('Your sign up request has been saved. Please check your email and click on the confirmation email to complete your signup.'));
                } else {
                    $this->Flash->error(__('The user could not be saved. Please, try again.'));
                }
            } else {
                $this->Flash->error(__("You have not confirmed that you are human. Please check the captcha box."));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Acl User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Acl User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        if ($id == 1) {
            $this->redirect(['action' => 'index']);
        }
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The physician has been deleted.'));
        } else {
            $this->Flash->error(__('The physician could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function dashboard() {
        $registryTable = TableRegistry::get('Registry.Registries');
        $count = $registryTable->userTotal(1, $this->request->session()->read('user_id'));
        $this->set(compact('count'));
    }

    public function summary() {
        $this->viewBuilder()->layout('ajax');
        $registryTable = TableRegistry::get('Registry.Registries');
        $summary = $registryTable->userSummary(1, $this->request->session()->read('user_id'));
        $this->set(compact('summary'));
        $this->set('_serialize', 'summary');
    }

    public function activate($email, $token) {
        if ($this->Users->isValidCode($email, $token)) {
            if ($this->Users->activate($email)) {
                $this->Flash->success(__('Your sign up request is now confirmed'));
                $user = $this->Users->find()->where(['email' => $email])->contain(['UserProfiles'])->first();
                //request administrator approval
                $approvalCode = $this->Users->generateToken();
                $user->code = $approvalCode;
                $this->Users->save($user);
                $message = "<p>A sign up request was received from</p>";
                $message .= "<p>Name: " . $user->user_profile->name . "</p>";
                $message .= "<p>Institution: " . $user->user_profile->institution . "</p>";
                $message .= "<p>Specialty: " . (($user->user_profile->specialty == 'Others') ? $user->user_profile->specialty_others : $user->user_profile->specialty) . "</p>";
                $message .= "<p>Country: Nigeria<p>";
                $message .= "<p>&nbsp;<p>";
                $message .= "<p>Click <a href='https://www.parkinsonnigeria.com/acl/users/approve/" . $user->email . "/" . $approvalCode . "'>here</a> to approve this request.<p>";
                $this->Mailgun->sendHTML('accounts@parkinsonnigeria.com', 'njide_okubadejo@yahoo.com', 'Request for approval: Nigeria Parkinson Disease Registry', $message);
                return $this->redirect(['action' => 'success', 'new']);
            } else {
                return $this->redirect(['action' => 'error', 'token']);
            }
        }
    }

    public function approve($email, $code) {
        $this->viewBuilder()->layout('default');
        if ($this->Users->isValidCode($email, $code)) {
            $user = $this->Users->find()->where(['email' => $email])->contain(['UserProfiles'])->first();
            $user->code = $this->Users->generateToken();
            $user->expiring = \Cake\Chronos\Chronos::now()->addHour(6);
            $user->role = 'approved';
            if ($this->Users->save($user)) {
                $this->Flash->success(__("The account has been approved"));
                //notify the user
                $link = "https://parkinsonnigeria.com/acl/users/reset/" . $user->email . "/" . $user->code . "/new";
                $message = sprintf(file_get_contents(CONFIG . 'emails/recovery.txt'), $user->user_profile->name, $user->username, $link, $link, $user->expiring);
                $this->Mailgun->sendHTML('accounts@parkinsonnigeria.com', $user->email, 'Account recovery - parkinsonnigeria.com', $message);
            }
        }
    }

    public function toggle($id, $from = 'index') {
        if ($this->request->is('post')) {
            $user = $this->Users->get($id);
            $user->status = ($user->status == 'active') ? 'inactive' : 'active';
            if ($this->Users->save($user)) {
                return $this->redirect(['action' => $from]);
            }
        }
    }

    public function login($status = null) {
        $this->viewBuilder()->layout('default');
        if ($this->request->is('post')) {
            if ($this->Users->isActivated($this->request->data['username'])) {
                $user = $this->Auth->identify();
                if ($user) {
                    if ($this->Auth2f->userRequires2fa($user)) {
                        //generate the 2f and send via email
                        $this->Auth2f->send2f($user);
                        return $this->redirect(['action' => 'token', $user['email']]);
                    } else {
                        $this->Auth->setUser($user);
                        $this->createSession($user);
                        //return $this->redirect($this->referer());
                        return $this->redirect($this->Auth->redirectUrl());
                    }
                }
                $this->Flash->error(__('Invalid username or password, try again'));
            }
        }
        $this->set(compact('status'));
    }

    public function token($email) {
        $this->viewBuilder()->layout('default');
        if ($this->request->is('post')) {
            $user = $this->Users->getUser($this->request->data('email'))->toArray();
            if (!isset($this->request->data['token'])) {
                $this->Auth2f->send2f($user);
            } else {
                if ($this->Auth2f->verify2f($user, $this->request->data('token'))) {
                    $this->Auth->setUser($user);
                    $this->createSession($user);
                    //return $this->redirect($this->referer());
                    return $this->redirect($this->Auth->redirectUrl());
                }
                $this->Flash->error('Token verification failed');
            }
        }
        $this->set(compact('email'));
    }

    public function logout() {
        //clear session
        $this->destroySession();
        //$this->request->session()->clear();
        return $this->redirect($this->Auth->logout());
    }

    public function recover($status = null) {
        $this->viewBuilder()->layout('default');
        if ($this->request->is('post')) {
            if ($this->Users->isValidEmail($this->request->data['email'])) {
                $user = $this->Users->getUser($this->request->data['email']);
                $user->code = $this->Users->generateToken();
                $expiry = new Carbon(null, 'Africa/Lagos');
                $expiry->addDays(1);
                $user->expiring = $expiry;
                if ($status == 'yes') {
                    $user->role = 'approved';
                }
                if ($this->Users->save($user)) {
                    //send an email with a token for reset that will expire in 1 hour
                    $message = sprintf('Your account have been reset ');
                    if ($status == 'yes') {
                        $this->resetTitle = 'Your account has been approved';
                        $message = 'Thanks for requesting to contribute to the Nigeria Parkinson Disease Registry. Your account has been approved, click the following link to set a password and begin using your account. ';
                    }
                    if ($user['password'] == '') {
                        $message .= $this->registrationUrl . 'acl/users/reset/' . $user->email . '/' . $user->code . '/new';
                    } else {
                        $message .= $this->registrationUrl . 'acl/users/reset/' . $user->email . '/' . $user->code . '/recover';
                    }
                    $this->Mailgun->send($this->registrationMail, $user->email, $this->resetTitle, $message);
                    if ($status == 'yes') {
                        $this->Flash->success(__('Approval notice has been sent to participant'));
                        return $this->redirect(['action' => 'requests']);
                    }
                    $this->redirect(['action' => 'success', 'recovery']);
                }
            } else {
                $this->redirect(['action' => 'error', 'recovery']);
            }
        }
    }

    public function reset($email, $code, $type) {
        $this->viewBuilder()->layout('default');
        if ($this->request->is('post')) {
            if ($this->request->data['password'] != '' && ($this->request->data['password'] == $this->request->data['password2'])) {
                if ($this->Users->reset($this->request->data['email'], $this->request->data['code'], $this->request->data['password'])) {
                    if ($type == 'new') {
                        //give the user the option of editing his profile
                        $this->Flash->success('Your password has been set successfully');
                        $user = $this->Auth->identify();
                        if ($user) {
                            $this->createSession($user);
                            return $this->redirect(['controller' => 'user-profiles', 'action' => 'edit']);
                        }
                    }
                    return $this->redirect(['action' => 'login']);
                } else {
                    
                }
            } else {
                
            }
        }
        if ($this->Users->isValidCode($email, $code)) {
            
        } else {
            //error
            $this->redirect(['action' => 'error', 'token']);
        }
        $this->set(compact('email', 'code', 'type'));
    }

    public function changepassword($status = null) {
        $this->viewBuilder()->layout('default');
        if ($this->request->is('post')) {
            if ($this->request->data['new_password'] != '' && ($this->request->data['new_password'] == $this->request->data['new_password2'])) {
                if ($this->Auth->identify()) {
                    if ($this->Users->changePassword($this->request->data['username'], $this->request->data['new_password'])) {
                        //redirect to the login page
                        $this->redirect(['action' => 'login']);
                    }
                }
            }
        }
        $user = $this->Auth->user();
        $email = $user['email'];
        $this->set(compact('email'));
    }

    public function privileges($id) {
        if ($this->request->is('post')) {
            //purge current roles
            $this->Users->UserRoles->deleteAll(['user_id' => $this->request->data['user_id']]);
            foreach ($this->request->data['user_roles'] as $role) {
                $userRoleEntity = $this->Users->UserRoles->newEntity(['user_id' => $this->request->data['user_id'], 'role_id' => $role['role_id'], 'assigned_by' => $this->Auth->user('id')]);
                $this->Users->UserRoles->save($userRoleEntity);
            }
        }
        //get the roles
        $roles = $this->Users->UserRoles->Roles->find();
        //get the user's current roles
        $currentRoles = $this->Users->getCurrentRoles($id);
        $this->set(compact('roles', 'id', 'currentRoles'));
    }

    public function terms() {
        
    }

    public function invite() {
        if ($this->request->is('post')) {
            //generate a token
            $token = $this->Users->generateToken();
            //create a user using this token and post data
            $administrator = ($this->request->data['administrator'] == 'yes') ? 1 : 0;
            $data = [
                'username' => $this->request->data['email'],
                'email' => $this->request->data['email'],
                'code' => $token,
                'is_system' => 0,
                'is_global' => $administrator,
                'user_profile' => [
                    'name' => $this->request->data['name'],
                    'institution' => '',
                ]
            ];
            $user = $this->Users->newEntity($data);
            $expiry = new Carbon(null, 'Africa/Lagos');
            $expiry->addDays(7);
            $user->expiring = $expiry;
            //save the user to database
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Invite has been sent'));
                //send an email to the user
                $link = sprintf("http://www.parkinsonnigeria.com/acl/users/reset/%s/%s/new", $this->request->data['email'], $token);
                $message = sprintf(file_get_contents(CONFIG . 'emails/invite.txt'), $this->request->data['name'], $link, $link);
                $this->Mailgun->sendHTML('invitation@parkinsonnigeria.com', $this->request->data['email'], 'Invitation from Nigeria Parkinson Disease Register', $message);
            }
        }
    }

    public function error($type) {
        $this->viewBuilder()->layout('default');
        $this->set(compact('type'));
    }

    public function success($type) {
        $this->viewBuilder()->layout('default');
        $this->set(compact('type'));
    }

    private function createSession($user) {
        $this->request->session()->write('username', $user['username']);
        $this->request->session()->write('user_id', $user['id']);
        $this->request->session()->write('is_system', $user['is_system']);
        $this->request->session()->write('is_global', $user['is_global']);
        $this->request->session()->write('name', $this->Users->getName($user['id']));
    }

    private function destroySession() {
        $this->request->session()->delete('username');
        $this->request->session()->delete('user_id');
        $this->request->session()->delete('is_system');
        $this->request->session()->delete('is_global');
        $this->request->session()->delete('name');
        $this->request->session()->destroy();
    }

}
