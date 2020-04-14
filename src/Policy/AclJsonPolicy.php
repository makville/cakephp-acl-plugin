<?php

namespace MakvilleAcl\Policy;

use App\Model\Entity\Article;
use Authorization\IdentityInterface;
use Cake\Http\ServerRequest;
use Cake\Utility\Inflector;

class AclJsonPolicy {

    private $authorizationChart = [];

    public function __construct() {
        if (file_exists(CONFIG . 'authorization.json')) {
            $this->authorizationChart = json_decode(file_get_contents(CONFIG . 'authorization.json'));
        } elseif (file_exists(ROOT . 'vendor/makville/cakephp-acl-plugin/config/authorization.json')) {
            $this->authorizationChart = json_decode(ROOT . 'vendor/makville/cakephp-acl-plugin/config/authorization.json');
        }
    }

    public function __call($method, $params) {
        $user = $params[0];
        $request = $params[1];
        return $this->authorize($user, $request);
    }

    private function authorize($user, $request) {
        $action = $this->getAction($request);
        $requirements = $this->getAuthorizationRequirements($action);
        if (count($requirements) > 0) {
            foreach ($requirements as $requirement) {
                $parts = explode(":", $requirement);
                $key = $parts[0];
                $value = $parts[1];
                $roles = $request->getSession()->read($key);
                if ((is_array($roles) && in_array($value, $roles)) || $user[$key] == $value) {
                    return true;
                }
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
        $parts = explode('.', $action);
        $queries = [];
        $queries[0] = $action;
        $queries[1] = $parts[0] . "." . $parts[1] . ".*";
        $queries[2] = $parts[0] . ".*";
        $requirements = [];
        foreach ($queries as $query) {
            foreach ($this->authorizationChart as $role => $actions) {
                if (in_array($query, $actions)) {
                    $requirements[] = $role;
                }
            }
        }
        return $requirements;
    }
    
    private function getAction (ServerRequest $request) {
        $plugin = $request->getParam('plugin');
        $controller = $request->getParam('controller');
        $action = $request->getParam('action');

        return "$plugin.$controller.$action";
    }
}
