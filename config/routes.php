<?php
if (isset($router)) {
    /** @var \RestaurantSearch\Components\Router\Router */
    $router->get('/restaurants', 'index@RestaurantsController');
}
