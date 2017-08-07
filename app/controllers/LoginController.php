<?php

class LoginController {

    function isWorking() {
        echo 'LoginController Homepage method is working!';
    }

    function isAlsoWorking() {
        echo "Hello from LoginController 'isAlsoWorking' method!";
        echo '<br><br>';
        echo 'Query String Parameters: ' . '<pre>' . print_r($_GET, true) . '</pre>';

    }
}