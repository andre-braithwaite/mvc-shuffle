<?php

class DeckController {

    function setDeck() {

        // Keep blue background when processing login
        echo '<body style=\'background-color:#3b5998;\'></body>';

        session_start();
        $_SESSION['activeDeck'] = $_REQUEST['active'];
        echo "<script>window.location='study-menu';</script>";
    }


    function studyMenu() {
        View::render('StudyMainView.php');
    }

    function removeDecks() {
        echo 'removing decks...';
    }


    function testCards() {
        View::render('TestCardsView.php');
    }
}