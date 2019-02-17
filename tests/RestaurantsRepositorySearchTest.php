<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use RestaurantSearch\Components\MathematicalDistanceCalculator\MathematicalDistanceCalculator;
use RestaurantSearch\Components\RestaurantLoaderFromJson\RestaurantLoaderFromJson;
use RestaurantSearch\Components\RestaurantsRepository\RestaurantsRepository;
use RestaurantSearch\Models\Restaurant;

final class  RestaurantsRepositorySearchTest extends TestCase
{
    /** @var  RestaurantsRepository */
    protected $restaurantsRepository;

    protected function setUp():void
    {
        $this->restaurantsRepository = new RestaurantsRepository(new RestaurantLoaderFromJson(),new MathematicalDistanceCalculator());

        $restaurant1 = new Restaurant();
        $restaurant1->setClientKey("e5CDWLrkOYxeissNSJ");
        $restaurant1->setRestaurantName("Thaimiddag");
        $restaurant1->setCuisine("Thai");
        $restaurant1->setCity("Stockholm");
        $restaurant1->setLatitude("59.332401");
        $restaurant1->setLongitude("18.006559");

        $restaurant2 = new Restaurant();
        $restaurant2->setClientKey("aaaaaa");
        $restaurant2->setRestaurantName("Name2");
        $restaurant2->setCuisine("Thai");
        $restaurant2->setCity("Stockholm");
        $restaurant2->setLatitude("59.555555");
        $restaurant2->setLongitude("18.555555");

        $restaurant3 = new Restaurant();
        $restaurant3->setClientKey("ZXa4NQMpEqXEUBnwGG");
        $restaurant3->setRestaurantName("Hai");
        $restaurant3->setCuisine("Sushi");
        $restaurant3->setCity("Malm\u00f6");
        $restaurant3->setLatitude("55.599091");
        $restaurant3->setLongitude("12.997970");

        $this->restaurantsRepository->setRestaurants([
            $restaurant1,
            $restaurant2,
            $restaurant3,
        ]);

    }

    /**
     *
     * @test
     */
    public function searchByRestaurantName(): void
    {
        /** @var  Restaurant[] $restaurants */
        $restaurants = $this->restaurantsRepository->filter(
            ['name'  => 'Name2']
        );

        $this->assertEquals(1, count($restaurants));
        $this->assertEquals("Name2", $restaurants[0]->getRestaurantName());
    }

    /**
     *
     * @test
     */
    public function searchByCuisine(): void
    {
        /** @var  Restaurant[] $restaurants */
        $restaurants = $this->restaurantsRepository->filter(
            ['cuisine'  => 'Thai']
        );

        $this->assertEquals(2, count($restaurants));
        foreach ($restaurants  as $restaurant) {
            $this->assertEquals("Thai", $restaurant->getCuisine());
        }
    }

    /**
     *
     * @test
     */
    public function searchByCity(): void
    {
        /** @var  Restaurant[] $restaurants */
        $restaurants = $this->restaurantsRepository->filter(
            ['city'  => 'Stockholm']
        );

        $this->assertEquals(2, count($restaurants));
        foreach ($restaurants  as $restaurant) {
            $this->assertEquals("Stockholm", $restaurant->getCity());
        }
    }

    /**
     *
     * @test
     */
    public function searchByDistance(): void
    {
        /** @var  Restaurant[] $restaurants */
        $restaurants = $this->restaurantsRepository->filter([
            'lat'  => '59',
            'long' => '18',
            'distance' => '100000'
        ]);

        $this->assertEquals(2, count($restaurants));

    }

    /**
     *
     * @test
     */
    public function freeTextSearch(): void
    {
        /** @var  Restaurant[] $restaurants */
        $restaurants = $this->restaurantsRepository->filter([
            'free_text'  => 'Name',
        ]);

        $this->assertEquals(1, count($restaurants));
        $this->assertEquals('Name2', $restaurants[0]->getRestaurantName());

    }
}