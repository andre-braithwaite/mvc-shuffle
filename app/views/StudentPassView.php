<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Please choose a new password</title>

    <!--<relative to -->
    <link rel="stylesheet" type="text/css" href="../public/style.css">

</head>

<body>

<div class="global-style">

    <h1 class="page-heading">Please choose a new password</h1>
    <div class="divider"></div>

    <div class="form">
        <form action="../user-model/set-pass" method="get">


            <input type="text" name="new-password" placeholder="new password"/>
            <div class="divider"></div>

            <button name="login">set password</button>


        </form>
    </div>
</div>
</body>
</html>