<?php

namespace RestaurantSearch\Components\RestaurantsRepository;

use RestaurantSearch\Interfaces\RestaurantsLoader;
use RestaurantSearch\Interfaces\RestaurantsRepository as RestaurantsRepositoryInterface;

class RestaurantsRepository implements RestaurantsRepositoryInterface
{
    private $restaurants  = [];

    public function __construct(RestaurantsLoader  $restaurantsLoader)
    {
        $this->restaurants = $restaurantsLoader->load();
    }

    /**
     * @return array|\RestaurantSearch\Models\Restaurant[]
     */
    public function getRestaurants()
    {
        return $this->restaurants;
    }

    /**
     * @param array|\RestaurantSearch\Models\Restaurant[] $restaurants
     */
    public function setRestaurants($restaurants)
    {
        $this->restaurants = $restaurants;
    }

    public function filter(array $filters)
    {
        $filteredRestaurants = [];

        foreach ($this->restaurants as  $restaurant) {
            if ($this->checkRestaurantAgainstFilter($restaurant, $filters)) {
                $filteredRestaurants[] = $restaurant;
            }
        }

        return $filteredRestaurants;
    }

    private function checkRestaurantAgainstFilter($restaurant, $filters)
    {
        return true;

    }
}