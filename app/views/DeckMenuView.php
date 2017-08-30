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

        <form action="../deck-controller/set-deck" method="post">

            <?php
            $deckLocation = DeckModel::deckFolder();

            // Supress missing directory error
            $decksDir = @opendir($deckLocation . $username . '/');

            if($decksDir){
                while(($deck = readdir($decksDir)) != false){
                    if($deck != '.' && $deck != '..' && $deck != '.htaccess'){

                        $deckName = substr($deck, 0, -4);
                        echo "<button type = submit name=\"active\" value = $deck onclick=\"window.location='setDeck.php'\">$deckName</button><br> ";

                    }
                }
                closedir($decksDir);
            }
            ?>
        </form>


    </div>


</div>
</body>
</html>
