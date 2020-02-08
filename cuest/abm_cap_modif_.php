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
     
        $id_capa = $_POST["id_capa"]; 
        $capa = $_POST["capa"];
        //modificar capa ----------------------------
        $sql = "update it_capas
                set capa = '$capa'
                where id_capa = '$id_capa'";

        if (mysqli_query($conn, $sql)) {
            ?> 
            <br><div class="container">
                <div class="alert alert-success">
                <?php echo 'Modificacion exitosa de la capa :'.$capa.' !';?></div>
                <a href="abm_cap.php" class="btn btn-info" role="button">Volver</a>
            </div><?php
        } 
        else {
            echo "Error: <br>".mysqli_error($conn);
        }?>
    </body>
</html>