<?php

namespace MakvilleAcl\Lib\ServiceProvider;

use Authorization\AuthorizationService;
use Authorization\AuthorizationServiceInterface;
use Authorization\AuthorizationServiceProviderInterface;
use Psr\Http\Message\ServerRequestInterface;
use MakvilleAcl\PolicyResolver\AclDbPolicyResolver;

abstract class ApplicationWithDbAuthorizationServiceProvider extends ApplicationWithAuthenticationServiceProvider implements AuthorizationServiceProviderInterface {
    
    public function getAuthorizationService(ServerRequestInterface $request): AuthorizationServiceInterface {
        $resolver = new AclDbPolicyResolver();
        
        return new AuthorizationService($resolver);
    }
}