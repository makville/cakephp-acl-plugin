<?php

declare(strict_types = 1);

namespace MakvilleAcl\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;

/**
 * Auth2fa component
 */
class Auth2faComponent extends Component {

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    
    public $components = ['MakvilleUtilities.Mailgun'];

    public function generate2f($user) {
        $g2f = mt_rand(100000, 999999);
        $this->_registry
                ->getController()
                ->getRequest()
                ->getSession()
                ->write('auth_2f', $g2f);
        $this->_registry
                ->getController()
                ->getRequest()
                ->getSession()
                ->write('auth_2f_user', $user);
        return $g2f;
    }
    
    public function verify2f($user, $r2f) {
        //is it the same account
        if ($this->_registry
                ->getController()
                ->getRequest()
                ->getSession()
                ->read('auth_2f_user')->email == $user->email) {
            if ($this->_registry
                ->getController()
                ->getRequest()
                ->getSession()
                ->read('auth_2f') == $r2f) {
                return true;
            }
        }
        return false;
    }
    
    public function send2f($user) {
        $token = $this->generate2f($user);
        $host = $this->_registry
                ->getController()
                ->getRequest()
                ->getAttribute('webroot');
        $message = sprintf(file_get_contents(\Cake\Core\Plugin::configPath('MakvilleAcl') . 'emails/2fa.txt'), $host, $user->email, $token, $host);
        $this->Mailgun->send(Configure::read('makville-acl-account-email-address'), $user->email, 'Your OTP', $message);
    }

}
