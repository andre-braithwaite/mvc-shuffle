<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Testing View receiving data</title>
        <link rel="stylesheet" type="text/css" href="../public/style.css">
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>

    </head>

    <body>
        <h1 class="page-heading">View sending / receiving data</h1>
        <div class="divider"></div>

        <div class="status-info">

            <input type = "button" value="<?php echo $name . ' : is logged in.';?>">
            <input type = "button" value="<?php echo $activeDeck . ' : is selected ';?>">
            <input type = "button" value="FAVOURITE COLOURS">

            <?php foreach ($colours as $colour): ?>
                <input type = "button" value="<?php echo $colour ?>">
            <?php endforeach;?>


            <div class="divider"></div>


            <input type="text" id ="startingNum" name="startingNum" placeholder="pick a number"/>
            <button id="testAjax" type="submit">Click to add 5 </button>
            <input type = "text"  id="result">


            <script>
                var submit_button = $('#testAjax');

                submit_button.click(function() {

                    var numEntered = document.getElementById("startingNum").value;
                    var totalButton = document.getElementById("result");

                    $.ajax({

                        type: 'GET',
                        url: 'test-response',
                        data: {startingNum: numEntered},

                        success: function(response) {
                            totalButton.value = response;
                        }
                    });
                });
            </script>
        </div>
    </body>
</html>
