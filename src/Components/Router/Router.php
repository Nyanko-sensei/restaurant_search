<?php

namespace RestaurantSearch\Components\Router;

use RestaurantSearch\Interfaces\DependencyContainer;

class Router
{
    /** @var DependencyContainer */
    private $dependencyContainer;
    private $routes = [];
    private $currentRoute;
    private $requestMethod;
    private $requestUri;

    public function __construct(DependencyContainer $dependencyContainer)
    {
        $this->dependencyContainer = $dependencyContainer;
    }

    public function get($uri, $handler)
    {
        $this->routes[$uri]["GET"] = $handler;
    }

    public function handle()
    {
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
        $this->requestUri = $_SERVER['REDIRECT_URL'];


        foreach ($this->routes as $route => $routInfo) {

            if (preg_match($this->prepareRoute($route), $this->requestUri, $matches)) {
                $this->currentRoute = $route;
            }
        }

        if (! $this->currentRoute) {
            throw new RouteNotFoundException('route not found');
        }

        if (! isset($this->routes[$this->currentRoute][$this->requestMethod])) {
            throw new MethodNotAllowedException('method not allowed');
        }

        $variables = $this->getVariables();

        $handler = explode('@', $this->routes[$this->currentRoute][$this->requestMethod]);

        $className = "RestaurantSearch\\Controllers\\" . $handler[1];
        $method = $handler[0];

        $controller = $this->dependencyContainer->get($className);

        if (! (method_exists($controller, $method))) {
            throw new InvalidMethodException();
        }

        $reflectionMethod = new \ReflectionMethod($className, $method);
        $methodParams = $reflectionMethod->getParameters();

        $dependencies = $this->dependencyContainer->getDependencies($methodParams, $variables);

        call_user_func_array([$controller, $method], $dependencies);
    }

    private function prepareRoute($route)
    {
        return '/^' . preg_replace(['/\{.*?\}/', '/\//'], ['(.*)', '\/'], $route) . '$/';
    }

    private function getVariables()
    {
        $variables = [];

        if (preg_match_all('/\{(.*?)\}/', $this->currentRoute, $names)) {
            $names = $names[1];
            preg_match($this->prepareRoute($this->currentRoute), $this->requestUri, $matches);
            foreach ($matches as $key => $match) {
                if (isset($names[$key - 1])) {
                    $variables[$names[$key - 1]] = $match;
                }
            }
        }

        return $variables;
    }
}