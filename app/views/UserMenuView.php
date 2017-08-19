<?php
    session_start();
    $username = $_SESSION['username'];
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


        <button type="button" onclick="window.location='show-decks';">
        choose a deck</button>

        <button type="button" onclick="window.location='../../../views/tests/user-logins/user-logins.html';">
        set password</button>

        <button style="background:darkred" type="button"
                onclick="window.location='../'";
                onmouseout="this.style.backgroundColor='darkred'";
                onmouseover="this.style.backgroundColor='firebrick'">log out</button>

    </div>


    </div>
    </body>
</html>