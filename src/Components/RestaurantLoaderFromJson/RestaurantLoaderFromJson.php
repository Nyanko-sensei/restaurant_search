<?php
/**
 * Created by PhpStorm.
 * User: radzeviciai
 * Date: 19.2.17
 * Time: 03.23
 */

namespace RestaurantSearch\Components\RestaurantLoaderFromJson;


use RestaurantSearch\Interfaces\RestaurantsLoader;
use RestaurantSearch\Models\Restaurant;

class RestaurantLoaderFromJson implements RestaurantsLoader
{
    const PATH = __DIR__.'/../../../data/backend-data.json';
    /***
     * @param null $path
     *
     * @return Restaurant[];
     */
    public function load($path = null): array
    {
        if(empty($path)) {
            $path  = self::PATH;
        }

        $restaurants = [];
        if (file_exists($path)) {
            $string = file_get_contents($path);
            $restaurantsData = json_decode($string, true);

            foreach ($restaurantsData as $restaurantData) {
                $restaurants[]  = $this->processJsonEntry($restaurantData);
            }
        }

        return $restaurants;
    }

    private function processJsonEntry($restaurantData):Restaurant
    {
        $restaurant = new Restaurant();

        $restaurant->setClientKey($restaurantData['clientKey'] ?? '');
        $restaurant->setRestaurantName($restaurantData['restaurantName'] ?? '');
        $restaurant->setCuisine($restaurantData['cuisine'] ?? '');
        $restaurant->setCity($restaurantData['city'] ?? '');
        $restaurant->setLatitude($restaurantData['latitude'] ?? '');
        $restaurant->setLongitude($restaurantData['longitude'] ?? '');

        return $restaurant;
    }
}