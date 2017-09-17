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



    <h1 class="page-heading"><?php echo $username . ' is logged in.';?></h1>
    <div class="divider"></div>

    <div class="status-info">

        <form enctype="multipart/form-data" action="../deck-model/uploading-xml" method="POST">

        <input type = "button" value="UPLOAD AN XML FILE" style="background:#006db9; color: white";>

        <input name="xml-file" type="file" />

        <button type="submit" value="Upload File">
            UPLOAD FILE</button>
        </form>



    </div>


</div>
</body>
</html>