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
    include '../seg_fx.php';
    include 'navig.php';

            //CERROJO: verificar si hay permisos eliminar factores 
            if(!hay_permiso($_SESSION["id_rol"], "factores", "B")){
          
              //  mensaje
              ?>
                  <br><div class="container">
                  <div class="alert alert-warning">No tiene permisos para esta accion!</div>
                  <a href="abm_fac.php" class="btn btn-info" role="button"> volver</a>
              <?php 
              exit();
            }
            // fin CERROJO -----------------------------------------------------
    

    $id_factor = $_GET["id"];

    $sql = "delete from factores
            where id_factor='$id_factor'";

    if (mysqli_query($conn, $sql)) {
      ?> 
      <br><div class="container">
          <div class="alert alert-success">
          <strong><?php echo 'Se ha eliminado el Factor';?></strong> 
          </div>
          <a href="abm_fac.php" class="btn btn-info" role="button">Volver</a>
          </div><?php
      } 
      else { 
        ?>
        <br><div class="container">
          <div class="alert alert-warning">
          <strong><?php echo "Error: ".mysqli_error($conn);?></strong> 
          </div>
          <a href="abm_fac.php" class="btn btn-info" role="button">Volver</a>
          </div><?php
      }?>
  </body>
</html>