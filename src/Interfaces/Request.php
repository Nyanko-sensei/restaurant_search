<?php

namespace RestaurantSearch\Interfaces;


interface Request
{
    public function get($name  = null);
    public function post($name  = null);
    public function input($name  = null);
}