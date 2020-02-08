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
      include '../cn_con.php';
      include 'navig.php';

    $factor = $_POST["factor"];
    $id_factor = $_POST["id_factor"];
    //modificar factor ----------------------------
    $sql = "update factores
            set factor = '$factor' 
            where id_factor = '$id_factor'"; 

        if (mysqli_query($conn, $sql)) {?> 
        <br><div class="container">
            <div class="alert alert-success">
            <strong><?php echo 'Modificacion exitosa de Factor';?></strong> 
            </div>
            <a href="abm_fac.php" class="btn btn-info" role="button">Volver</a>
            </div><?php
        } 
        else {
            echo "Error: ".$query."<br>".mysqli_error($conn);
        }?>
    </body>
</html>