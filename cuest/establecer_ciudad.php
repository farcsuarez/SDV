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
        include '../fx.php';
        include '../seg_fx.php';
        include 'navig.php';
        
        //CERROJO: verificar si hay permisos
     if(!hay_permiso($_SESSION["id_rol"], "ci_ciudades", "M")){
                
        //  mensaje
        ?>
            <br><div class="container">
            <div class="alert alert-warning">No tiene permisos para esta accion!</div>
            <a href="../abms/abm_ciu.php" class="btn btn-info" role="button"> volver</a>
        <?php 
        exit();
      }
      // fin CERROJO -----------------------------------------------------
        
            $_SESSION["id_ciudad"] = $_GET["id"]; 
            $ciudad = ciudad($_SESSION["id_ciudad"])["ciudad"]; ?>
    
            <div class="container">
                <div class="alert alert-success"><?php echo 'Ciudad de '.$ciudad.', establecida'; ?></div>
                <a href="../abms/abm_ciu.php" class="btn btn-info" role="button">Volver</a>
            </div>
        
    </body>
</html>