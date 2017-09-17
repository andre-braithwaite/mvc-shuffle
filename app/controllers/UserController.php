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

    function importDeck() {
        View::render('ImportDeckView.php');
    }

    function importXml() {
        View::render('ImportingXmlView.php');
    }

    function importCsv() {
        View::render('ImportingCsvView.php');
    }

}