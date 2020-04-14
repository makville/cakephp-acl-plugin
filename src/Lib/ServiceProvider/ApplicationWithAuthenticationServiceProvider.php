<?php
namespace MakvilleAcl\Lib\ServiceProvider;

use Cake\Http\BaseApplication;
use Authentication\AuthenticationService;
use Authentication\AuthenticationServiceInterface;
use Authentication\AuthenticationServiceProviderInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class ApplicationWithAuthenticationServiceProvider extends BaseApplication implements AuthenticationServiceProviderInterface {
    /**
     * Returns a service provider instance.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request Request
     * @return \Authentication\AuthenticationServiceInterface
     */
    public function getAuthenticationService(ServerRequestInterface $request): AuthenticationServiceInterface {
        $service = new AuthenticationService();
        $service->setConfig([
            'unauthenticatedRedirect' => \Cake\Routing\Router::url(['plugin' => 'MakvilleAcl', 'controller' => 'Users', 'action' => 'login']),
            'queryParam' => 'redirect',
        ]);

        $fields = [
            'username' => 'email',
            'password' => 'password'
        ];

        // Load the authenticators, you want session first
        $service->loadAuthenticator('Authentication.Session');
        $service->loadAuthenticator('Authentication.Form', [
            'fields' => $fields,
            'loginUrl' => \Cake\Routing\Router::url(['plugin' => 'MakvilleAcl', 'controller' => 'Users', 'action' => 'login'])
        ]);

        // Load identifiers
        $service->loadIdentifier('Authentication.Password', compact('fields'));

        return $service;
    }
}