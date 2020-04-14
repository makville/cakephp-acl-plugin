<?php

namespace MakvilleAcl\Lib\ServiceProvider;

use Authorization\AuthorizationService;
use Authorization\AuthorizationServiceInterface;
use Authorization\AuthorizationServiceProviderInterface;
use Psr\Http\Message\ServerRequestInterface;
use MakvilleAcl\PolicyResolver\AclJsonPolicyResolver;

abstract class ApplicationWithJsonAuthorizationServiceProvider extends ApplicationWithAuthenticationServiceProvider implements AuthorizationServiceProviderInterface {
    
    public function getAuthorizationService(ServerRequestInterface $request): AuthorizationServiceInterface {
        $resolver = new AclJsonPolicyResolver();
        
        return new AuthorizationService($resolver);
    }
}