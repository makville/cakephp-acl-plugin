<?php

namespace Acl\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;

/**
 * Acl component
 */
class Auth2fComponent extends Component {
    
    public $components = ['Mailgun'];
    
    private $user2fa = ['ayomakanjuola@gmail.com'];
    
    public function userRequires2fa ($user) {
        if (!in_array($user['email'], $this->user2fa)) {
            return true;
        }
        return false;
    }

    public function generate2f($user) {
        $g2f = mt_rand(100000, 999999);
        $this->request->session()->write('auth_2f', $g2f);
        $this->request->session()->write('auth_2f_user', $user);
        return $g2f;
    }
    
    public function verify2f($user, $r2f) {
        //is it the same account
        if ($this->request->session()->read('auth_2f_user')['email'] == $user['email']) {
            if ($this->request->session()->read('auth_2f') == $r2f) {
                return true;
            }
        }
        return false;
    }
    
    public function send2f($user) {
        $token = $this->generate2f($user);
        $message = "Please use this token: $token to complete your sign in.";
        $this->Mailgun->send($this->_registry->getController()->registrationMail, $user['email'], 'Your single use token', $message);
    }
}
