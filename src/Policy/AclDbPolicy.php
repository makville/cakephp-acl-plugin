<?php

namespace MakvilleAcl\Policy;

use App\Model\Entity\Article;
use Authorization\IdentityInterface;
use Cake\Http\ServerRequest;

class AclDbPolicy {

    public function __call($method, $params) {
        $user = $params[0];
        $request = $params[1];
        return $this->authorize($user, $request);
    }

    protected function authorize($user, $request) {
        $action = $this->getAction($request);
        $requiredRoles = $this->getAuthorizationRequirements($action);
        if (count($requiredRoles) > 0) {
            $userRoles = $request->getSession()->read('role');
            $intersect = array_intersect($requiredRoles, $userRoles);
            if (count($intersect) > 0) {
                return true;
            }
            return false;
        } else {
            if (\Cake\Core\Configure::read('makville-acl-allow-permissive-authorization')) {
                return true;
            }
            return false;
        }
    }

    private function getAuthorizationRequirements($action) {
        $roles = [];
        $locator = \Cake\ORM\TableRegistry::getTableLocator();
        $config = $locator->exists('MakvilleAcl.ModuleActions') ? [] : ['className' => 'MakvilleAcl\Model\Table\ModuleActionsTable'];
        $table = $locator->get('ModuleActions', $config);
        $moduleActions = $table->find()->where(['name' => $action])->contain(['RoleActions'])->toArray();
        foreach ($moduleActions as $moduleAction) {
            foreach ($moduleAction->role_actions as $roleAction) {
                $roles[] = $roleAction->role_id;
            }
        }
        return $roles;
    }

    private function getAction(ServerRequest $request) {
        $plugin = $request->getParam('plugin');
        $controller = $request->getParam('controller');
        $action = $request->getParam('action');

        return "$plugin.$controller.$action";
    }

}
