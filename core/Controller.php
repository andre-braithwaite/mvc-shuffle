<?php

abstract class Controller {

    function printParams() {

        $currentClass = get_class($this);

        echo "Hello from the '" . __FUNCTION__ . "' method in the '$currentClass' class.";
        echo '<br><br>';
        echo 'Route Parameters: ' . '<pre>' . print_r($this->route_params, true) . '</pre>';
        echo '<br>';
        echo 'Query String Parameters: ' . '<pre>' . print_r($_GET, true) . '</pre>';
    }

    protected $route_params = [];

    function __construct($route_params) {
        $this->route_params = $route_params;
    }

}