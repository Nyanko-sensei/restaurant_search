<?php

use RestaurantSearch\Components\DependencyInjectionContainer\DependencyInjectionContainer;

require_once   'vendor/autoload.php';

$dependencyInjectionContainer = new DependencyInjectionContainer();

require_once 'config/interfaceImplementationMap.php';

$router = new RestaurantSearch\Components\Router\Router($dependencyInjectionContainer);

require_once 'config/routes.php';

try {
    $router->handle();
//} catch (\RestaurantSearch\Components\Router\MethodNotAllowedException $e) {
//    //@todo
//} catch (\RestaurantSearch\Components\Router\RouteNotFoundException $e) {
//    //@todo
} catch (Exception $e) {
    var_dump($e);
    //@todo
}



/*
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        $responseHandler->fail('Route not found');
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $responseHandler->fail('Method not allowed');
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = explode('@',$routeInfo[1]);

        $vars = $routeInfo[2];

        $controllerClass =  "UserListRest\\Controllers\\".$handler[1];
        $method =  $handler[0];

        if (!$containerBuilder->has($controllerClass)) {
            $responseHandler->fail('Class not loaded');
            break;
        }

        $controller = $containerBuilder->get($controllerClass);

        if(!(method_exists($controller, $method))) {
            $responseHandler->fail('Method does not exist');
            break;
        }

        $controller->$method($vars);

        break;
}

*/