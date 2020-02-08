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
    include '../seg_fx.php';
    include '../cn_con.php';
    include 'navig.php';

    //CERROJO: verificar si hay permisos
    if(!hay_permiso($_SESSION["id_rol"], "ci_provincias", "B")){
                
      //  mensaje
      ?>
          <br><div class="container">
          <div class="alert alert-warning">No tiene permisos para esta accion!</div>
          <a href="abm_prov.php" class="btn btn-info" role="button"> volver</a>
      <?php 
      exit();
    }
    // fin CERROJO -----------------------------------------------------

    $id_provincia = $_GET["id"];
    $provincia = provincia($id_provincia)["provincia"];

    $sql = "delete from ci_provincias
            where id_provincia = '$id_provincia'";

    if (mysqli_query($conn, $sql)) {
      ?> 
      <br><div class="container">
          <div class="alert alert-success"><?php echo 'Se ha eliminado '.$provincia;?></div>
          <a href="abm_prov.php" class="btn btn-info" role="button">Volver</a></div><?php
      } 
      else { 
        ?>
        <br><div class="container">
          <div class="alert alert-warning"><?php echo "Error: ".mysqli_error($conn);?></div>
          <a href="abm_prov.php" class="btn btn-info" role="button">Volver</a>
          </div><?php
      }?>
  </body>
</html>
