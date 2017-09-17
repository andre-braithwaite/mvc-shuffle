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
        session_start();
        $username = $_SESSION['username'];
        $activeDeck = $_SESSION['activeDeck'];


        $deleteMe= DeckModel::deckFolder() . $username . '/' . $activeDeck;

        DeckModel::removeDeck($deleteMe);


    }


    function testCards() {
        View::render('TestCardsView.php');
    }

    function finishedTest() {
        View::render('FinishedTestingView.php');
    }

    function viewDeck() {
        View::render('DeckView.php');
    }

    function resetDeck() {
        View::render('ResetDeckView.php');
    }

    // Card processing functions

    function gotRight($answerGiven, $correctAnswer) {
        if (strtolower($answerGiven) == strtolower($correctAnswer)){
            return true;
        } else {
            return false;
        }
    }

    function giveFeedback($gotRight, $seconds, $feedbackQuestion, $correctAnswer){
        if($gotRight){
            if ($seconds > 6) {
                return 'Fantastic! you had ' . $seconds . ' seconds left!';
            } elseif ($seconds > 3){
                return 'Great job! you had ' . $seconds . ' seconds left!';
            } elseif ($seconds > 1){
                return 'Well done! you had ' . $seconds . ' seconds left!';
            } elseif ($seconds == 1){
                return 'Nice! you had ' . $seconds . ' second left!';
            } else {
                return 'Good, you answered correctly!';
            }
        } else {
            return 'Wrong! \'' . $feedbackQuestion . '\' means \'' . $correctAnswer . '\'';
        }
    }


    function processNew() {

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

        if (self::gotRight($answerWord, $correctAnswer)){
            // update eFactor
            $grade = DeckModel::speedGrade($seconds);
            DeckModel::newE($deckXML,$activeCard, $grade);

            // Update due date
            DeckModel::newDate($deckXML, $activeCard);
        } else {
            // update eFactor
            $grade = 0;
            DeckModel::newE($deckXML,$activeCard, $grade);

            // Update due date
            DeckModel::againToday($deckXML, $activeCard);
        }

        // Decrement cards left to review
        $temp = $_SESSION['newToTest'];
        $_SESSION['newToTest'] = $temp - 1;


        $newLeft = $_SESSION['newToTest'];


        // Set the next card to test
        $_SESSION['activeCard'] = DeckModel::getNewCard($deckXML);
        $_SESSION['activeQuestion'] = DeckModel::getField($deckXML, $_SESSION['activeCard'], 'question');

        // Flag we've run out of new questions if the active question results in an empty string
        if (($_SESSION['activeQuestion'] == '') or ($_SESSION['newToTest'] <= 0)) {
            $newDone = 'true';
            $_SESSION['activeCard'] = DeckModel::getReviewCard($deckXML);
            $_SESSION['activeQuestion'] = DeckModel::getField($deckXML, $_SESSION['activeCard'], 'question');

        }
        $reviewLeft = DeckModel::numReview($deckXML);


        $goodAnswer = self::gotRight($answerWord, $correctAnswer);
        $feedback = self::giveFeedback($goodAnswer, $seconds, $feedbackQuestion, $correctAnswer);

        // Send back response

        $response = array(
            "feedback"=>$feedback,
            "nextQuestion"=>'\'' . $_SESSION['activeQuestion'] . '\'',
            "newLeft"=>$newLeft,
            "newDone"=>$newDone,
            "reviewLeft"=>$reviewLeft);

        header("Content-Type: application/json");
        echo json_encode($response);
    }

    function processReview() {

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

        if (self::gotRight($answerWord, $correctAnswer)){
            // update eFactor
            $grade = DeckModel::speedGrade($seconds);
            DeckModel::newE($deckXML,$activeCard, $grade);

            // Update due date
            DeckModel::newDate($deckXML, $activeCard);

        } else {
            // update eFactor
            $grade = 0;
            DeckModel::newE($deckXML,$activeCard, $grade);

            // Update due date
            DeckModel::againToday($deckXML, $activeCard);

        }
        $reviewLeft = DeckModel::numReview($deckXML);



        // Set the next card to test
        $_SESSION['activeCard'] = DeckModel::getReviewCard($deckXML);
        $_SESSION['activeQuestion'] = DeckModel::getField($deckXML, $_SESSION['activeCard'], 'question');


        $goodAnswer = self::gotRight($answerWord, $correctAnswer);
        $feedback = self::giveFeedback($goodAnswer, $seconds, $feedbackQuestion, $correctAnswer);

        // Send back response

        $response = array(
            "feedback"=>$feedback,
            "nextQuestion"=>'\'' . $_SESSION['activeQuestion'] . '\'',
            "reviewLeft"=>$reviewLeft,
            "newDone"=>'true');

        header("Content-Type: application/json");
        echo json_encode($response);
    }

}