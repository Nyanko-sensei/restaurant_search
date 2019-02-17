<?php

use RestaurantSearch\Components\DependencyInjectionContainer\DependencyInjectionContainer;

require_once   'vendor/autoload.php';

$dependencyInjectionContainer = new DependencyInjectionContainer();

require_once 'config/interfaceImplementationMap.php';

$responseHandler = $dependencyInjectionContainer->get(\RestaurantSearch\Interfaces\Response::class);

$router = new RestaurantSearch\Components\Router\Router($dependencyInjectionContainer);

require_once 'config/routes.php';

try {
    $router->handle();
} catch (\RestaurantSearch\Components\Router\MethodNotAllowedException $e) {
    $responseHandler->fail(empty($e->getMessage())?'method not allowed' : $e->getMessage());
} catch (\RestaurantSearch\Components\Router\RouteNotFoundException $e) {
    $responseHandler->fail(empty($e->getMessage())?'route not found' : $e->getMessage());
} catch (Exception $e) {
    $responseHandler->fail(empty($e->getMessage())?'something went wrong' : $e->getMessage());
}
