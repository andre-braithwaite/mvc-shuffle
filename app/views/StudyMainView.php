<?php
session_start();
$username = $_SESSION['username'];
$activeDeck = $_SESSION['activeDeck'];

//echo $username . '<br>';
echo $activeDeck;
?>



