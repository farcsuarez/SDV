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

      //CERROJO: verificar si hay permisos
      if(!hay_permiso($_SESSION["id_rol"], "it_capas", "B")){
                
        //  mensaje
        ?>
            <br><div class="container">
            <div class="alert alert-warning">No tiene permisos para esta accion!</div>
            <a href="abm_cap.php" class="btn btn-info" role="button"> volver</a>
        <?php 
        exit();
      }
      // fin CERROJO -----------------------------------------------------

    $id = $_GET["idcap"];
    $sql = "delete from it_capas where id_capa='$id'";
    if (mysqli_query($conn, $sql)) {
      ?> 
      <br><div class="container">
          <div class="alert alert-success">
          <strong><?php echo 'Capa removida!';?></strong> 
          </div>
          <a href="abm_cap.php" class="btn btn-info" role="button">Volver</a>
      </div><?php
      } 
      else {
        echo "Error: <br>".mysqli_error($conn);
      }?>
  </body>
</html>