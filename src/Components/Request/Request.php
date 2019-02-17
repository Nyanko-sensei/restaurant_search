<?php

namespace RestaurantSearch\Components\Request;


use RestaurantSearch\Interfaces\Request as RequestInterface;

class Request implements RequestInterface
{
    private $postVariables;
    private $getVariables;
    private $inputs;

    public function __construct()
    {
        $this->postVariables = $_POST ?? [];
        $this->getVariables = $_GET ?? [];
        $this->inputs = array_merge($this->postVariables, $this->getVariables);
    }

    public function get($name = null)
    {
        if (empty($name)) {
            return $this->getVariables;
        }

        return $this->getVariables[$name] ?? null;
    }

    public function post($name = null)
    {
        if (empty($name)) {
            return $this->postVariables;
        }

        return $this->postVariables[$name] ?? null;
    }

    public function input($name = null)
    {
        if (empty($name)) {
            return $this->inputs;
        }

        return $this->inputs[$name] ?? null;
    }
}