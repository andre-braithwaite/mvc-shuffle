<?php
session_start();
$deleteMe = $_REQUEST['deleteMe'];
$_SESSION['deleteMe'] = $deleteMe;

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
        <input type = "button" value="DELETING USER" style="background:red; color: white">
        <input type = "button" value="<?php echo $deleteMe;?>" style="background:#006db9; color: white">



        <button

            style="background:darkred"
            onmouseout="this.style.backgroundColor='darkred'";
            onmouseover="this.style.backgroundColor='firebrick'"
            onclick="window.location='../user-controller/do-delete'";

        >remove this user</button>


    </div>


</div>
</body>
</html>



