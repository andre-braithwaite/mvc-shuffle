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

<!-- Log Out Button-->
<input type="button" style='float: right; background:darkred'
       value ='LOG OUT'
       class ='logout'
       onmouseout="this.style.backgroundColor='darkred'";
       onmouseover="this.style.backgroundColor='firebrick'"
       onclick="window.location='../login-controller/go-home'";/><br>

<div class="global-style">


    <div class="divider"></div>


    <div class="status-info">

        <button type="button" onclick="window.location='go-admin';">
            return to administration area</button>

    </div>

    <div class="status-info">






        <form action="../login-controller/confirm-delete" method="get">

            <input type = "button" value="PLEASE CHOOSE A USER TO DELETE" style="background:#006db9; color: white">
            <?php
            $decksFolder = DeckModel::deckFolder();

            $userDir = '../app/models/data/';
            $users = UserModel::getUsers($userDir);

            // Make a button for each deck in the users directory
            foreach($users as $user) {

                echo "<button type = submit name=\"deleteMe\" value = $user >$user</button><br> ";
            }

            ?>
        </form>


    </div>


</div>
</body>
</html>
