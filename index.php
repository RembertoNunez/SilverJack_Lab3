<?php
    include 'inc/functions.php'; // reference the function page
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset=utf-8 />
        <meta name="description" content="description">
        <title>SilverJack</title>
        <style>
            @import url("css/styles.css");
        </style>
    </head>
        <body>
             <h1>SilverJack</h1>
            <div id="gameState" >
               
            <?php
                play(); // function call
            ?>
            <form>
                <input type="submit" class="submit" value="Play Again!">
            </form>
            </div>
        </body>
</html>