<?php

namespace RestaurantSearch\Controllers;

use RestaurantSearch\Interfaces\Request;
use RestaurantSearch\Interfaces\Response;
use RestaurantSearch\Interfaces\RestaurantsRepository;
use RestaurantSearch\Transformers\RestaurantTransformer;

class RestaurantsController
{
    public function index(RestaurantsRepository $restaurantsRepository, Request $request, Response $response)
    {
        $restaurants = $restaurantsRepository->filter($request->input());

        $response->success(RestaurantTransformer::transformMany($restaurants));
    }
}