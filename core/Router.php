<?php

// Decides which controller and action to run based on the url
// Translate url into a class and a method to use


class Router {

    // An array of (key, value) pairs, the "routing table"
    protected  $routes = [];

    // Array of parameters from the matched route
    protected $params = [];


    // Method to add routes to the routing table
    function add($route, $params) {
        $this->routes[$route] = $params;
    }

    // Method to get all the routes in the table
    public function getRoutes() {
        return $this->routes;
    }

    // Method to take url from the query string and match this to a route in the routing table
    function match($url) {
        foreach($this->routes as $route => $params) {
            if ($url == $route) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    // Method to get currently matched parameters
    function getParams() {
        return $this->params;
    }


}