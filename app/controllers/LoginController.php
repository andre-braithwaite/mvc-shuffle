<?php

class LoginController extends Controller {

    public function goHome() {
        View::render('LoginView.php');
    }

    function processLogin() {

        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        $do_login = false;


    if (LoginModel::databaseFound()){
        $xml = LoginModel::xmlElement();

        if ((LoginModel::userFound($xml, $username)) && (LoginModel::passCorrect($xml, $username, $password))){
            $do_login = true;
        } else {
            View::render('LoginErrorView.php');
        }


    }
        //echo $do_login ? 'true' : 'false';
        //echo 'username entered: ' . $username . '<br>';
        //echo 'password entered: ' . $password;
    }
}