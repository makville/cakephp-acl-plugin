<?php

declare(strict_types = 1);

namespace MakvilleAcl\Controller;

use App\Controller\AppController as BaseController;

class AppController extends BaseController {
    
    public function initialize(): void {
        parent::initialize();
        $this->loadComponent('MakvilleAcl.Acl');
        $this->loadComponent('MakvilleAcl.Auth2fa');
        $this->loadComponent('Authentication.Authentication');
        $this->Authentication->allowUnauthenticated(['login', 'token2fa', 'logout', 'signup', 'activate', 'recover', 'reset', 'notify']);
        if (!in_array('ControlPanel', $this->components()->loaded())) {
            $this->loadComponent('MakvilleControlPanel.ControlPanel');
            $this->viewBuilder()->setLayout($this->ControlPanel->getLayout());
        }
    }
}
