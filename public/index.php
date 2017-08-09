<?php

// Front Controller, every request goes through here.
// Route comes in through the url query string and is matched with the correct method

// Require all classes in a given folder
function requireClasses($src) {

    foreach (glob($src) as $filename) {
        require $filename;
    }
}

// Load Classes
requireClasses("../core/*.php");
requireClasses("../app/controllers/*.php");
requireClasses("../app/models/*.php");

$router = new Router();

$url = $_SERVER['QUERY_STRING'];
$router->dispatch($url);
