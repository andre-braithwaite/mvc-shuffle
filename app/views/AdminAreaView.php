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

<!-- Log Out Button-->
<input type="button" style='float: right; background:darkred'
       value ='LOG OUT'
       class ='logout'
       onmouseout="this.style.backgroundColor='darkred'";
       onmouseover="this.style.backgroundColor='firebrick'"
       onclick="window.location='../login-controller/go-home'";/><br>

<div class="global-style">



    <h1 class="page-heading"><?php echo 'Administration Area';?></h1>
    <div class="divider"></div>

    <div class="status-info">

        <input type = "button" value="PLEASE CHOOSE A TASK" style="background:#006db9; color: white";>


        <button type="button" onclick="window.location='change-admin';">
            CHANGE PASSWORD</button>

        <button type="button" onclick="window.location='delete-user';">
            DELETE A USER</button>



    </div>


</div>
</body>
</html>