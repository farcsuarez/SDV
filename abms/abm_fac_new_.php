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
    <?php
        include '../top.php';
        include '../cn_con.php';
        include 'navig.php';

        //fijar eje-dimension
        $_SESSION["eje_dimension"] = $_POST["eje_dimension"];

        $id_eje = explode("-", $_POST["eje_dimension"])[2];
        $id_factor = $_POST["id_factor"];
        $factor = $_POST["factor"];

        //almacenar nuevo eje ----------------------------
        $sql = "insert into factores
        (id_factor, id_eje, factor) values
        ('$id_factor', '$id_eje', '$factor')";

        if (mysqli_query($conn, $sql)) {
            ?> 
        <br><div class="container">
            <div class="alert alert-success">
            <strong><?php echo 'Alta exitosa de Factor';?></strong> 
            </div>
            <a href="abm_fac.php" class="btn btn-info" role="button">Volver</a>
            </div><?php
        } 
        else { 
            echo "Error: ".$query."<br>".mysqli_error($conn);
        }?>
    </body>
</html>