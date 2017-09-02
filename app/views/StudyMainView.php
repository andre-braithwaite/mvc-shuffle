<?php
session_start();
$username = $_SESSION['username'];
$activeDeck = $_SESSION['activeDeck'];

//echo $username . '<br>';
//echo $activeDeck;
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
        <input type = "button" value="ACTIVE DECK" style="background:#006db9; color: white">
        <input type = "button" value="<?php echo $activeDeck;?>" style="background:#006db9; color: white">


        <!-- Draw a table-->
        <button type="button" onclick="window.location='view-deck';">
            view questions</button>

        <button type="button" onclick="window.location='test-cards';">
            start testing</button>


    </div>


</div>
</body>
</html>



