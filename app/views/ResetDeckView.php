<?php
session_start();
$username = $_SESSION['username'];
$activeDeck = $_SESSION['activeDeck'];
$deckXML = DeckModel::deckFolder() . $username . '/' . $activeDeck;
DeckModel::resetStats($deckXML);

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

    <h1  class="page-heading" ><?php echo $username . ' is logged in.';?></h1>
    <div class="divider"></div>

    <div class="status-info">
        <input type = "button" value="DECK RESET SUCCESSFULLY!" style="background:#006db9; color: white">

        <button type="button" onclick="window.location='../user-controller/main-menu';">
            main menu</button>
    </div>
</body>
</html>