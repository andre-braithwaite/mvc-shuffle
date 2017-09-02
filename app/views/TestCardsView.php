<?php
session_start();
// Declare new session variable
$_SESSION['activeCard'];

$username = $_SESSION['username'];
$activeCard = $_SESSION['activeCard'];
$activeDeck = $_SESSION['activeDeck'];
$deckXML = DeckModel::deckFolder() . $username . '/' . $activeDeck;

// Choose the first card to test
$activeCard = '0001';
// Get the first question
$activeQuestion = DeckModel::getField($deckXML, $activeCard, 'question')


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

            <form action="process-answer" method="get">

                <input type = "button" value="PLEASE TRANSLATE" style="background:#006db9; color: white">

                <input type = "button"
                       style="background:#006db9; color: white" value="<?php echo '\'' . $activeQuestion . '\'';?>">

                <input placeholder="answer here" type="text" name="suppliedAnswer" style="text-align:center"/>

                <div class="divider"></div>
                <button type="submit">check my answer</button>
                <input type = "text"  id="seconds" background="#4CAF50" style="text-align:center;" name="secondsRemaining" >
            </form>

        </div>
    </div>
</body>
</html>