<?php

namespace RestaurantSearch\Interfaces;


interface DestinationCalculator
{
    public function getDistance(float $lat1, float $long1, float $lat2, float $long2);
}