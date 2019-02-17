<?php

namespace RestaurantSearch\Interfaces;

use RestaurantSearch\Models\Restaurant;

interface RestaurantsLoader
{
    /***
     * @param null $path
     *
     * @return Restaurant[];
     */
    public function load($path = null):array ;
}