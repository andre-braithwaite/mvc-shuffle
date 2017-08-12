<?php

class LoginController extends Controller {

    public function goHome() {
        View::render('LoginView.php');
    }

    function userFound($xml, $username) {

        $userExists = false;

        foreach ($xml->children() as $user) {
            if ($username == $user->username) {
                $userExists = true;
            }
        }

        if ($userExists) {
            return true;
        } else {
            return false;
        }
    }

    function passCorrect($xml, $username, $password) {

        $goodPass = false;

        foreach ($xml->children() as $user) {
            if ($username == $user->username && $password == $user->password) {
                $goodPass = true;
            }
        }

        if ($goodPass) {
            return true;
        } else {
            return false;
        }
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