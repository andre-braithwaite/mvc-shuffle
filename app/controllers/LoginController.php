<?php

class LoginController extends Controller {

    public function goHome() {
        View::render('LoginView.php');
    }

    function processLogin() {

        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        $do_login = false;


    LoginModel::databaseFound();

        //echo 'username entered: ' . $username . '<br>';
        //echo 'password entered: ' . $password;
    }
}