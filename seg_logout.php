<?php session_start();?>
<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <?php session_destroy(); 
            include 'top.php';
        ?>
        <div class="container">
            <br><br>
            <div class="shadow p-4 mb-4 bg-white">SESION CERRADA!</div>
        </div>
    </body>
</html>