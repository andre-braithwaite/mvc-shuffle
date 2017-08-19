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
        } else {
            View::render('LoginErrorView.php');
        }

        // If the username and password are both correct,
        //start a new session and go to users homepage
        if($do_login) {

            // Start a new session and create a session variable to track the user logged in
            session_start();
            $_SESSION['username'] = $username;
            echo("<script>window.location = '../user-controller/user-menu';</script>");
            die;
        }
    }
}
