<?php
session_start();
// Declare new session variables
$_SESSION['activeCard'];
$_SESSION['activeQuestion'];


$username = $_SESSION['username'];
$activeDeck = $_SESSION['activeDeck'];
$deckXML = DeckModel::deckFolder() . $username . '/' . $activeDeck;

// Check how many new cards are available
$numNew = DeckModel::numNew($deckXML);

$startMessage = $numNew . ' NEW CARDS REMAINING';

// Choose the first card to test
$_SESSION['activeCard'] = DeckModel::getNewCard($deckXML);

// Get the first question
$_SESSION['activeQuestion'] = DeckModel::getField($deckXML, $_SESSION['activeCard'], 'question')


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

                    var resultArea = document.getElementById("result");
                    var questionArea = document.getElementById("activeQ");
                    var remainingArea = document.getElementById("cardsLeft");

                    var answerWord = document.getElementById("answerWord").value;
                    var seconds = document.getElementById("seconds").value;

                    $.ajax({

                        type:'GET',
                        url: 'process-card',
                        data: {answerWord: answerWord, seconds: seconds},
                        dataType: "JSON",

                        success: function(response) {
                            resultArea.value = response.feedback;
                            questionArea.value = response.nextQuestion;

                            remainingArea.value = response.newLeft + ' NEW CARDS REMAINING';

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