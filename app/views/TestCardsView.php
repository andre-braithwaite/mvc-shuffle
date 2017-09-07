<?php
// Keep blue background when checking cards to review
echo '<body style=\'background-color:#3b5998;\'></body>';

session_start();
// Declare new session variables
$_SESSION['activeCard'];
$_SESSION['activeQuestion'];


$username = $_SESSION['username'];
$activeDeck = $_SESSION['activeDeck'];

$deckXML = DeckModel::deckFolder() . $username . '/' . $activeDeck;

// Set how many new cards to test
$_SESSION['newToTest'] = DeckModel::newToTest($deckXML);;


// Start testing
if($_SESSION['newToTest'] > 0) {
    $startMessage = $_SESSION['newToTest'] . ' NEW CARDS REMAINING';
    $_SESSION['activeCard'] = DeckModel::getNewCard($deckXML);
    $_SESSION['activeQuestion'] = DeckModel::getField($deckXML, $_SESSION['activeCard'], 'question');
} else {
    echo "<script>window.location='review-cards';</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test User Logins</title>
    <link rel="stylesheet" type="text/css" href="../public/style.css">
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="../app/js/countdown.js"></script>

    <!-- Start counting down -->
    <script>countdown();</script>
</head>

<body>
    <div class="global-style">
            <h1 class="page-heading"><?php echo $username . ' is logged in.';?></h1>

            <div class="divider"></div>
        <div class="status-info">

                <input type = "button" id="cardsLeft" value="<?php echo $startMessage ?>" style="background:#006db9; color: white">
                <input type = "button" value="PLEASE TRANSLATE" style="background:#006db9; color: white">

                <input type = "button"
                       id = "activeQ"
                       style="background:#006db9; color: white" value="<?php echo '\'' . $_SESSION['activeQuestion'] . '\'';?>">

                <input placeholder="answer here" type="text"  id ="answerWord" style="text-align:center"/>

                <div class="divider"></div>
                <button id="testAjax" type="submit">click to check answer</button>
                <input type = "text"  id="seconds" background="#4CAF50" style="text-align:center;" name="secondsRemaining" >

                <input type = "text"  id="result">


            <script>
                var submit_button = $('#testAjax');

                submit_button.click(function() {

                    var process = 'process-new';

                    var resultArea = document.getElementById("result");
                    var questionArea = document.getElementById("activeQ");
                    var remainingArea = document.getElementById("cardsLeft");

                    var answerWord = document.getElementById("answerWord").value;
                    var seconds = document.getElementById("seconds").value;

                    $.ajax({

                        type:'GET',
                        url: process,
                        data: {answerWord: answerWord, seconds: seconds},
                        dataType: "JSON",

                        success: function(response) {

                                alert(response.reviewDone);

                            if (response.newDone){

                                if (response.reviewLeft == '0'){
                                    window.location='finished-test';
                                }

                                process = 'process-review';
                                if(response.reviewLeft != 1) {
                                    remainingArea.value = response.reviewLeft + ' CARDS LEFT TO REVIEW';
                                } else {
                                    remainingArea.value = response.reviewLeft + ' CARD LEFT TO REVIEW';
                                }
                            } else {

                                if(response.newLeft != 1) {
                                    remainingArea.value = response.newLeft + ' NEW CARDS REMAINING';
                                } else {
                                    remainingArea.value = response.newLeft + ' NEW CARD REMAINING';
                                }
                            }

                            resultArea.value = response.feedback;
                            questionArea.value = response.nextQuestion;


                            //Reset countdown and input box for the new question
                            secs = 10;
                            countdown();
                            document.getElementById("answerWord").value = '';
                        }
                    });
                });
            </script>



        </div>
    </div>
</body>
</html>