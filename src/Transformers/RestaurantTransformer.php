<?php

namespace RestaurantSearch\Transformers;


use RestaurantSearch\Models\Restaurant;

class RestaurantTransformer
{
    static public function transform(Restaurant $restaurant): array
    {
        return [
            'clientKey' => $restaurant->getClientKey(),
            'restaurantName' => $restaurant->getRestaurantName(),
            'cuisine' => $restaurant->getCuisine(),
            'city' => $restaurant->getCity(),
            'latitude' => $restaurant->getLatitude(),
            'longitude' => $restaurant->getLongitude(),
        ];
    }

    static public function transformMany(array $restaurants): array
    {
        $transformedRestaurants = [];

        foreach ($restaurants as $restaurant) {
            $transformedRestaurants[] = self::transform($restaurant);
        }

        return $transformedRestaurants;
    }
}