<?php

namespace RestaurantSearch\Components\MathematicalDistanceCalculator;


use RestaurantSearch\Interfaces\DestinationCalculator;

class MathematicalDistanceCalculator implements DestinationCalculator
{
    const EARTH_RADIUS = 6371000;
    /**
     * Math copied from
     * https://stackoverflow.com/questions/10053358/measuring-the-distance-between-two-coordinates-in-php
     */
    public function getDistance(float $lat1, float $long1, float $lat2, float $long2)
    {
        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($long1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($long2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

        return $angle * self::EARTH_RADIUS;
    }
}