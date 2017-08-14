<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Welcome to Shuffle</title>

        <!--<relative to -->
        <link rel="stylesheet" type="text/css" href="../public/style.css">

    </head>

    <body>

    <?php

    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $xml = LoginModel::xmlElement();

    echo '<div class="status-info">';

        // Print login information
        echo '<input type="button" value = "USER DATABASE EXISTS" style="background:#4CAF50;color: #FFFFFF">';

        // Check user exists
        if (LoginModel::userFound($xml, $username)) {
        echo '<input type="button" value = "USER FOUND" style="background:#4CAF50;color: #FFFFFF">';
        } else {
        echo '<input type="button" value = "USER NOT FOUND!" style="background:darkred;color: #FFFFFF">';
        echo "<input type = \"button\" name=\"active\" value = \"username entered: $username\" /><br> ";

        }

        // Print message if the password entered is wrong
        if ((LoginModel::userFound($xml, $username)) && !(LoginModel::passCorrect($xml, $username, $password))) {
        echo '<input type=button value = "WRONG PASSWORD!" style="background:darkred;color: #FFFFFF">';
        echo "<input type = \"button\" name=\"active\" value = \"username entered: $username\" /><br> ";
        echo "<input type = \"button\" name=\"active\" value = \"password entered: $password\" /><br> ";


        }

        //echo '</div>';

        echo "<button type=\"button\" onclick=\"window.location='../';\">try again</button>";


    ?>
    </body>
</html>