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

    $id_dim = explode("-", $_POST["id_dimension"])[0];
    $id_eje = $_POST["id_eje"];
    $eje = $_POST["eje"];

    //almacenar nuevo eje ----------------------------
    $sql = "insert into ejes
    (id_dimension, id_eje, eje) values
    ('$id_dim', '$id_eje', '$eje')";

        if (mysqli_query($conn, $sql)) {
            ?> 
        <br><div class="container">
            <div class="alert alert-success">
            <strong><?php echo 'Alta exitosa de Eje';?></strong> 
            </div>
            <a href="abm_eje.php" class="btn btn-info" role="button">Volver</a>
            </div><?php
        } 
        else { 
            ?><br><div class="container">
        <div class="alert alert-warning">
        <strong><?php echo "Error: ".mysqli_error($conn);?></strong> 
        </div>
        <a href="abm_eje.php" class="btn btn-info" role="button">Volver</a>
        </div><?php
        }?>
    </body>
</html>