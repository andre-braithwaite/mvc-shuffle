<?php

class LoginController extends Controller {

    public function goHome() {
        View::render('LoginView.php');
    }

    function processLogin() {
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];

        echo 'username entered: ' . $username . '<br>';
        echo 'password entered: ' . $password;
    }

    function testingView() {
        View::render('TestView.php', [
            'name' => 'NAME_DATA',
            'activeDeck' => 'DECK_DATA',
            'colours' => ['RED', 'GREEN', 'BLUE'],
            'fromModel' => $this->testingModel()
        ]);
    }

    function testingModel() {
        return LoginModel::testMethod();
    }

}