<?php
    include 'inc/functions.php'; // reference the function page
?>
<!DOCTYPE html>
<html>
    <head>
        <title> SilverJack </title>
         <style type="text/css">
            @import url("css/styles.css");
        </style>
        <body>
            <div id="gameState" >
            <?php
                generateDeck();
            ?>
            </div>
        </body>
    </head>
</html>
