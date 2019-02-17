<?php
/**
 * Created by PhpStorm.
 * User: radzeviciai
 * Date: 19.2.17
 * Time: 03.09
 */

namespace RestaurantSearch\Components\Request;


use RestaurantSearch\Interfaces\Request as RequestInterface;

class Request implements RequestInterface
{
    public function get($name = null)
    {
        echo("test");
        // TODO: Implement get() method.
    }
}