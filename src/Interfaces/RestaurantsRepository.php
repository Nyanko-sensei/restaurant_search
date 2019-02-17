<?php

namespace RestaurantSearch\Interfaces;


interface RestaurantsRepository
{
    public function filter(array $filters);
}