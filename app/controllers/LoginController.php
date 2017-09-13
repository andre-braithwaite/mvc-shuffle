<?php

class LoginController extends Controller {

    public function goHome() {
        View::render('LoginView.php');
    }


    public function goAdmin() {
        View::render('AdminLogin.php');
    }


    public function newUser() {
        View::render('CreateUserView.php');
    }



    function processLogin() {

        // Keep blue background when processing login
        echo '<body style=\'background-color:#3b5998;\'></body>';

        // Go to create a new user if the new user button is clicked
        if ($_REQUEST['newUser'] == true) {
            echo("<script>window.location = 'new-user';</script>");
        };

        // Go to create a new user if the new user button is clicked
        if ($_REQUEST['tools'] == true) {
            echo("<script>window.location = 'go-admin';</script>");
        };

        session_start();
        // Keep blue background when processing login
        //echo '<body style=\'background-color:#3b5998;\'></body>';


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
            echo("<script>window.location = '../user-controller/main-menu';</script>");
            die;
        }
    }

    function addUser() {

        // Keep blue background when processing login
        echo '<body style=\'background-color:#3b5998;\'></body>';

        // Go to create a new user if the new user button is clicked
        if ($_REQUEST['newUser'] == true) {
            echo("<script>window.location = 'new-user';</script>");
        };

        // Go to create a new user if the new user button is clicked
        if ($_REQUEST['tools'] == true) {
            echo("<script>window.location = 'go-admin';</script>");
        };

        session_start();
        // Keep blue background when processing login
        //echo '<body style=\'background-color:#3b5998;\'></body>';


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
            echo("<script>window.location = '../user-controller/main-menu';</script>");
            die;
        }
    }

}
