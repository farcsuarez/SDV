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

        $eje = $_POST["eje"];
        $id_eje = $_POST["id_eje"];
        //modificar eje ----------------------------
        $sql = "update ejes set eje = '$eje' 
                where id_eje = '$id_eje'"; 

        if (mysqli_query($conn, $sql)) {
            ?> 
            <br><div class="container">
                <div class="alert alert-success">
                <strong><?php echo 'Modificacion exitosa de Eje';?></strong> 
                </div>
                <a href="abm_eje.php" class="btn btn-info" role="button">Volver</a>
                </div><?php  
        } 
        else {
            echo "Error: ".$query."<br>".mysqli_error($conn);
        }?>
    </body>
</html>

