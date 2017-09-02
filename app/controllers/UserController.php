<?php

class UserController extends Controller {

    function mainMenu() {
        View::render('UserMainView.php');
    }

    function showDecks() {
        View::render('DeckMenuView.php');
    }



}