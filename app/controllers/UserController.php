<?php

class UserController extends Controller {

    function userMenu() {
        View::render('UserMenuView.php');
    }

    function showDecks() {
        View::render('DeckMenuView.php');
    }



}