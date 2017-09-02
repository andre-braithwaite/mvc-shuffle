<?php

session_start();
// Create new session variable
$_SESSION["activeDeck"] = "none";

$username = $_SESSION['username'];
$userFolder = $username . '/';
$activeDeck = $_SESSION['activeDeck'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test User Logins</title>
    <link rel="stylesheet" type="text/css" href="../public/style.css">
</head>

<body>

<div class="global-style">


    <h1 class="page-heading"><?php echo $username . ' is logged in.';?></h1>
    <div class="divider"></div>

    <div class="status-info">

        <form action="../deck-controller/set-deck" method="get">

            <input type = "button" value="PLEASE CHOOSE YOUR DECK" style="background:#006db9; color: white">
            <?php
            $deckLocation = DeckModel::deckFolder();

            // Supress missing directory error
            $decksDir = @opendir($deckLocation . $username . '/');
            $userDecks = DeckModel::getDecks($decksDir);

            // Make a button for each deck in the users directory
            foreach($userDecks as $deck) {
                echo "<button type = submit name=\"active\" value = $deck >$deck</button><br> ";
            }

            ?>
        </form>


    </div>


</div>
</body>
</html>
