<?php

namespace RestaurantSearch\Components\RestaurantsRepository;

use RestaurantSearch\Interfaces\DestinationCalculator;
use RestaurantSearch\Interfaces\RestaurantsLoader;
use RestaurantSearch\Interfaces\RestaurantsRepository as RestaurantsRepositoryInterface;
use RestaurantSearch\Models\Restaurant;

class RestaurantsRepository implements RestaurantsRepositoryInterface
{
    /** @var Restaurant[] */
    private $restaurants = [];
    /** @var DestinationCalculator */
    private $destinationCalculator;

    public function __construct(RestaurantsLoader $restaurantsLoader, DestinationCalculator $destinationCalculator)
    {
        $this->restaurants = $restaurantsLoader->load();
        $this->destinationCalculator = $destinationCalculator;
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

        foreach ($this->restaurants as $restaurant) {
            if ($this->checkRestaurantAgainstFilter($restaurant, $filters)) {
                $filteredRestaurants[] = $restaurant;
            }
        }

        return $filteredRestaurants;
    }

    private function checkRestaurantAgainstFilter(Restaurant $restaurant, $filters)
    {

        if (! empty($filters['name']) && strpos($restaurant->getRestaurantName(), $filters['name']) === false) {
            return false;
        }

        if (! empty($filters['cuisine']) && strpos($restaurant->getCuisine(), $filters['cuisine']) === false) {
            return false;
        }

        if (! empty($filters['city']) && strpos($restaurant->getCity(), $filters['city']) === false) {
            return false;
        }

        if (! empty($filters['free_text'])
            && strpos($restaurant->getClientKey(), $filters['free_text']) === false
            && strpos($restaurant->getRestaurantName(), $filters['free_text']) === false
            && strpos($restaurant->getCuisine(), $filters['free_text']) === false
            && strpos($restaurant->getCity(), $filters['free_text']) === false
            ) {
            return false;
        }

        if (! empty($filters['lat']) && ! empty($filters['long']) && ! empty($filters['distance']) && $this->destinationCalculator->getDistance($restaurant->getLatitude(),
                $restaurant->getLongitude(), $filters['lat'], $filters['long']) >= $filters['distance']) {
            return false;
        }

        return true;
    }
}