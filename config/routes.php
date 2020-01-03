<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;
use Cake\Core\Configure;

Router::plugin('MakvilleAcl', ['path' => Configure::read('makville-acl-path', '/makville-acl')],
    function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);
    }
);
