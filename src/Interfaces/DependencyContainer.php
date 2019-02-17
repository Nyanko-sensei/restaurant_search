<?php

namespace RestaurantSearch\Interfaces;


interface DependencyContainer
{
    public function get($name);

    public function getDependencies($parameters, $params);
}