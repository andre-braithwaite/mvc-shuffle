<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Testing View receiving data</title>
        <link rel="stylesheet" type="text/css" href="../public/style.css">
    </head>

    <body>
        <h1 class="page-heading">Testing View receiving data</h1>
        <div class="divider"></div>

        <div class="status-info">

            <input type = "button" value="<?php echo $name . ' : is logged in.';?>">
            <input type = "button" value="<?php echo $activeDeck . ' : is selected ';?>">
            <input type = "button" value="FAVOURITE COLOURS">

            <?php foreach ($colours as $colour): ?>
                <input type = "button" value="<?php echo $colour ?>">
            <?php endforeach;?>
        </div>
    </body>
</html>
