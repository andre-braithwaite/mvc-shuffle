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


    // Card processing functions

    function gotRight($answerGiven, $correctAnswer) {
        if ($answerGiven == $correctAnswer){
            return true;
        } else {
            return false;
        }
    }

    function giveFeedback($gotRight, $seconds, $feedbackQuestion, $correctAnswer){
        if($gotRight){
            if ($seconds > 6) {
                return 'Fantastic! you had ' . $seconds . ' seconds remaining!';
            } elseif ($seconds > 3){
                return 'Great job! you had ' . $seconds . ' seconds remaining!';
            } elseif ($seconds > 1){
                return 'Well done! you had ' . $seconds . ' seconds remaining!';
            } elseif ($seconds == 1){
                return 'Nice! you had ' . $seconds . ' second remaining!';
            } else {
                return 'Good, you answered correctly!';
            }
        } else {
            return 'Wrong! \'' . $feedbackQuestion . '\' means \'' . $correctAnswer . '\'';
        }
    }

    function processCard() {

        // Get input variables
        $answerWord = $_GET['answerWord'];
        $seconds = $_GET['seconds'] ;

        // Get session variables
        session_start();
        $username = $_SESSION['username'];
        $activeCard = $_SESSION['activeCard'];
        $feedbackQuestion = $_SESSION['activeQuestion'];
        $activeDeck = $_SESSION['activeDeck'];

        // Local variables
        $deckXML = DeckModel::deckFolder() . $username . '/' . $activeDeck;
        $correctAnswer = DeckModel::getField($deckXML, $activeCard, 'answer');

        // Set the next card to test
        $_SESSION['activeCard'] = '0002';
        $_SESSION['activeQuestion'] = DeckModel::getField($deckXML, $_SESSION['activeCard'], 'question');

        $goodAnswer = self::gotRight($answerWord, $correctAnswer);
        $feedback = self::giveFeedback($goodAnswer, $seconds, $feedbackQuestion, $correctAnswer);

        // Grade response

        // Update due date and eFactor

        // Send response

        $response = array("feedback"=>$feedback,"nextQuestion"=>'\'' . $_SESSION['activeQuestion'] . '\'');
        header("Content-Type: application/json");
        echo json_encode($response);




    }

}