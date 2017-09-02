<?php

class DeckController {

    function setDeck() {
        //echo 'setting deck...' . '<br>';
        //print_r($_POST);
        session_start();

        $_SESSION['activeDeck'] = $_REQUEST['active'];
        //print_r($_SESSION['activeDeck']);



        echo "<script>window.location='study-menu';</script>";
    }

    function studyMenu() {
        View::render('StudyMainView.php');

    }

    function removeDecks() {
        echo 'removing decks...';
    }

}