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

        $id_dim = $_POST["id_dimension"];
        $dim = $_POST["dimension"];

        //modificar dimension ----------------------------
        $sql = "update dimensiones
            set dimension='$dim' where id_dimension='$id_dim'"; 

        if (mysqli_query($conn, $sql)) {
            ?><br><div class="container">
            <div class="alert alert-success">
            <strong><?php echo 'Modificacion exitosa de Dimension';?></strong> 
            </div>
            <a href="abm_dim.php" class="btn btn-info" role="button">Volver</a>
            </div><?php
        } 
        else {
            echo "Error: ".$query."<br>".mysqli_error($conn);
        }?>
    </body>
</html>