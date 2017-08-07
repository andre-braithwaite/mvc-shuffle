<?php

// Decides which controller and action to run based on the url query string
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
        /*
        foreach($this->routes as $route => $params) {
            if ($url == $route) {
                $this->params = $params;
                return true;
            }
        }
        return false;
        */

        // Match to url format '/controller/method'
        // Small letters and dashes allowed
        $regex = "/^(?P<controller>[a-z-]+)\/(?P<method>[a-z-]+)$/";

        if (preg_match($regex, $url, $matches)){

            $params = [];

            foreach($matches as $key => $match) {
                if(is_string($key)) {
                    $params[$key] = $match;
                }
            }

            $this->params = $params;
            return true;
        }


    }

    // Method to get currently matched parameters
    function getParams() {
        return $this->params;
    }

    // Execute the routed method
    function dispatch($url) {

        //echo 'Dispatching route!';
        if ($this->match($url)) {
            $controller = $this->params['controller'];
            $controller = $this->convertToStudly($controller);

            if (class_exists($controller)) {
                $controller_obj = new $controller();

                $method = $this->params['method'];
                $method = $this->convertToCamel($method);

                if(is_callable([$controller_obj, $method])) {
                    $controller_obj->$method();
                } else {
                    echo "Method '$method' was not found in $controller";
                }
            } else {
                echo "Class '$controller' was not found";
            }
        } else {
            echo 'Route was not matched!';
            echo '<br>';
            echo "Routes must be in the format 'controller/method'";

        }
    }


    // Convert a string with dashes to Studly caps
    function convertToStudly($str) {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $str)));
    }

    //  Convert a string with dashes to Camel case
    function convertToCamel($str) {
        return lcfirst($this->convertToStudly($str));
    }


}
