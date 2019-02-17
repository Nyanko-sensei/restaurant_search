<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use RestaurantSearch\Components\RestaurantLoaderFromJson\RestaurantLoaderFromJson;
use RestaurantSearch\Models\Restaurant;

final class  JsonLoaderTest extends TestCase
{
    /**
     *
     * @test
     */
    public function canGetUsersFromJson(): void
    {
        $payload = [
            [
                "clientKey" => "e5CDWLrkOYxeissNSJ",
                "restaurantName" => "Thaimiddag",
                "cuisine" => "Thai",
                "city" => "Stockholm",
                "latitude" => "59.332401",
                "longitude" => "18.006559"
            ],
            [
                "clientKey" => "ZXa4NQMpEqXEUBnwGG",
                "restaurantName" => "Hai",
                "cuisine" => "Sushi",
                "city" => "Malm\u00f6",
                "latitude" => "55.599091",
                "longitude" => "12.997970"
            ],
        ];


        $fp = fopen('test.json', 'w');
        fwrite($fp, json_encode($payload));
        fclose($fp);

        $jsonLoader = new RestaurantLoaderFromJson();
        /** @var Restaurant[] $users */
        $restaurants = $jsonLoader->load('test.json');

        $restaurant1 = $restaurants[0];
        $restaurant2 = $restaurants[1];

        $this->assertEquals("e5CDWLrkOYxeissNSJ", $restaurant1->getClientKey());
        $this->assertEquals("Thaimiddag", $restaurant1->getRestaurantName());
        $this->assertEquals("Thai", $restaurant1->getCuisine());
        $this->assertEquals("Stockholm", $restaurant1->getCity());
        $this->assertEquals("59.332401", $restaurant1->getLatitude());
        $this->assertEquals("18.006559", $restaurant1->getLongitude());

        $this->assertEquals("ZXa4NQMpEqXEUBnwGG", $restaurant2->getClientKey());
        $this->assertEquals("Hai", $restaurant2->getRestaurantName());
        $this->assertEquals("Sushi", $restaurant2->getCuisine());
        $this->assertEquals("Malm\u00f6", $restaurant2->getCity());
        $this->assertEquals("55.599091", $restaurant2->getLatitude());
        $this->assertEquals("12.997970", $restaurant2->getLongitude());



        unlink('test.json');
    }
}