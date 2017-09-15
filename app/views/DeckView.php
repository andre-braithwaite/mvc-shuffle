<?php
session_start();
$username = $_SESSION['username'];
$activeDeck = $_SESSION['activeDeck'];
$deckXML = DeckModel::deckFolder() . $username . '/' . $activeDeck;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test User Logins</title>
    <link rel="stylesheet" type="text/css" href="../public/style.css">
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
</head>
<body>

<!-- Log Out Button-->
<input type="button" style='float: right; background:darkred'
       value ='LOG OUT'
       class ='logout'
       onmouseout="this.style.backgroundColor='darkred'";
       onmouseover="this.style.backgroundColor='firebrick'"
       onclick="window.location='../login-controller/go-home'";/><br>


<div class = "global-style">

    <h1 class="page-heading"><?php echo substr($activeDeck, 0, -4);?></h1>

<div class = "status-info">
    <button type="button" onclick="window.location='../user-controller/main-menu';">
        main menu</button>
</div>

</div>

<div align = 'center' id="table-here" ></div>
<script>

    function getXML(myUrl) {

        var xhr = $.ajax({
            url:      myUrl,
            datatype: "xml",
            async:    false,

            // Basic error checking
            success: function()	{
                //alert("XML Loaded!");
            },
            error: function() {
                alert("XML Failed to Load");
            }


        });
        return xhr.responseXML;

    }

    var xmlDoc = getXML("<?php echo $deckXML;?>");
    var stylesheet = getXML("../public/table.xsl");
    if (typeof (XSLTProcessor) != "undefined") {
        var processor = new XSLTProcessor();
        processor.importStylesheet(stylesheet);
        var result = processor.transformToFragment(xmlDoc, document);
        document.getElementById("table-here").appendChild(result);
    } else
        window.alert("Your browser does not support the XSLTProcessor object");

</script>

</body>
</html>