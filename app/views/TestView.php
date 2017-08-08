<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Testing View receiving data</title>
        <link rel="stylesheet" type="text/css" href="../public/style.css">
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>

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





            <div class="divider"></div>

            <!--<form action="test-response" method="get">-->
                <input type="text" name="startingNum" placeholder="pick a number"/>
                <button id="testAjax" type="submit">Click to add 5 </button>
            </form>
            <input type = "text"  id="result" value="0">


            <script>
                var submit_button = $('#testAjax');

                submit_button.click(function() {

                    //window.alert("did you click?");


                    var update_button = $('#result');
                    //window.alert("did you click?");

                    $.ajax({

                        type: 'GET',
                        url: 'test-response',
                        success: function(response) {
                            window.alert(response);
                            //update_div.html(response);
                        }
                    });



                });
            </script>



        </div>
    </body>
</html>
