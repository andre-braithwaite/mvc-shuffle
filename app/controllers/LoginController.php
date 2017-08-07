<?php

class LoginController extends Controller {

    public function goHome() {
        View::render('LoginView.php');
    }

    function isWorking() {
        echo 'LoginController Homepage method is working!';
    }

    function isAlsoWorking() {
        echo "Hello from LoginController 'isAlsoWorking' method!";
        echo '<br><br>';
        echo 'Query String Parameters: ' . '<pre>' . print_r($_GET, true) . '</pre>';
    }

    function testReceived() {

        $a = $_GET["a"];
        $b = $_GET["b"];

        echo "a was $a";
        echo "<br>";
        echo "b was $b";
    }
}