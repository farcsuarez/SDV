<?php session_start(); ?>
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
    <?php 
        include '../top.php';
        include '../fx.php';
        include '../cn_con.php';
        include 'navig.php';
        $capa = $_POST["capa"];

        //almacenar nueva capa ----------------------------
        $sql = "insert into it_capas 
                (capa) values ('$capa')";

        if (mysqli_query($conn, $sql)) {
            ?> 
            <br><div class="container">
                <div class="alert alert-success">
                <strong><?php echo 'Alta exitosa de la capa :'.$capa.' !';?></strong> 
                </div>
                <a href="abm_cap.php" class="btn btn-info" role="button">Volver</a>
            </div><?php
        } 
        else {
            echo "Error: <br>".mysqli_error($conn);
        }?>
    </body>
</html>