<?php

// Front Controller, every request goes through here.
/* Route comes in through the url query string and is matched with the correct method using the routing table */

//echo 'URL Requested = ' . $_SERVER['QUERY_STRING'];

require '../core/Router.php';
requireClasses("../controllers/*.php");

// Require all my Controller Classes

$router = new Router();

// Test correctly loading the class
// echo get_class($router);

// Add the routes to the table
// Empty route takes us to the login homepage
$router->add('',['controller'=> 'LoginController', 'method' => 'isWorking']);

// login route runs the login method
$router->add('login',['controller'=> 'LoginController', 'method' => 'isAlsoWorking']);




/*
// Check the table is accepting new routes
// The route is the key for the array
echo '<pre>';
var_dump($router->getRoutes());
echo '</pre>';
*/

// Matching the requested route
$url = $_SERVER['QUERY_STRING'];

if ($router->match($url)) {
    echo '<pre>';
    var_dump($router->getParams());
    echo '</pre>';
} else {
    echo 'No route found for the URL: ' . $url;
}


function requireClasses($src) {

    foreach (glob($src) as $filename) {
        require $filename;
    }
}

