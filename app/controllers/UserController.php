<?php

class UserController extends Controller {

    function mainMenu() {
        View::render('UserMainView.php');
    }

    function showDecks() {
        View::render('DecksMainView.php');
    }

    function changePass() {
        View::render('StudentPassView.php');
    }

}