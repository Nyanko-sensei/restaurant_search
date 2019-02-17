<?php

namespace RestaurantSearch\Interfaces;


interface Response
{
    public function fail(string $msg);
    public function success(array $payload);
}