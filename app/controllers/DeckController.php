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

    function processCard() {
        //echo $_GET['answerWord'] . ', '. $_GET['seconds'] ;

        session_start();
        $username = $_SESSION['username'];
        $activeCard = $_SESSION['activeCard'];
        $activeDeck = $_SESSION['activeDeck'];
        $deckXML = DeckModel::deckFolder() . $username . '/' . $activeDeck;



        $answer = $_GET['answerWord'];
        $correctAnswer = DeckModel::getField($deckXML, $activeCard, 'answer');

        if ($answer == $correctAnswer) {
            echo 'That\'s Right!';
        } else {
            echo 'Wrong! The corect answer is ' . $correctAnswer;
        }


    }

}