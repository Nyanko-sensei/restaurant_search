<?php
$dependencyInjectionContainer->set(RestaurantSearch\Interfaces\Request::class,
    RestaurantSearch\Components\Request\Request::class);

$dependencyInjectionContainer->set(RestaurantSearch\Interfaces\RestaurantsLoader::class,
    RestaurantSearch\Components\RestaurantLoaderFromJson\RestaurantLoaderFromJson::class);

$dependencyInjectionContainer->set(RestaurantSearch\Interfaces\RestaurantsRepository::class,
    RestaurantSearch\Components\RestaurantsRepository\RestaurantsRepository::class);

$dependencyInjectionContainer->set(RestaurantSearch\Interfaces\Response::class,
    RestaurantSearch\Components\Response\JsonResponse::class);

$dependencyInjectionContainer->set(RestaurantSearch\Interfaces\DestinationCalculator::class,
    RestaurantSearch\Components\MathematicalDistanceCalculator\MathematicalDistanceCalculator::class);