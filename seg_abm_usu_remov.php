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
    include 'top.php';
    include 'cn_con.php';
    include 'navig.php';
    include 'seg_fx.php';

    //CERROJO: verificar si hay permisos BAJA USUARIO 
    if(!hay_permiso($_SESSION["id_rol"], "seg_usuarios", "B")){
        
        //  mensaje
        ?>
            <br><div class="container">
            <div class="alert alert-warning">No tiene permisos para esta accion!</div>
        <?php 
        exit();
     }
     // fin CERROJO -----------------------------------------------------
    
    $id_usuario = $_GET["id"];

    $sql = "delete from seg_usuarios
            where id_usuario = '$id_usuario'";

    if (mysqli_query($conn, $sql)) {?> 
    <br><div class="container">
        <div class="alert alert-success">Se ha eliminado el usuario</div>
        <a href="seg_abm_usu.php" class="btn btn-info" role="button">Volver</a></div><?php
    } 
    else { ?>
      <br><div class="container">
        <div class="alert alert-warning"><?php echo "Error: ".mysqli_error($conn);?></div>
        <a href="seg_abm_usu.php" class="btn btn-info" role="button">Volver</a>
        </div><?php
    }?>
             
    </body>
</html>