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
            if(!hay_permiso($_SESSION["id_rol"], "it_categorias", "B")){
                          
              //  mensaje
              ?>
                  <br><div class="container">
                  <div class="alert alert-warning">No tiene permisos para esta accion!</div>
                  <a href="abm_cat.php" class="btn btn-info" role="button"> volver</a>
              <?php 
              exit();
            }
            // fin CERROJO -----------------------------------------------------


      $id = $_GET["idcat"];
      $sql = "delete from it_categorias where id_categoria='$id'";
      $categ = categoria($id);

      if (mysqli_query($conn, $sql)) {
        ?> 
        <br>
        <div class="container">
          <div class="alert alert-success">
            <strong><?php echo 'Eliminación de la categoria: '.$categ.' ,exitosa!';?></strong> 
          </div>
          <a href="abm_cat.php" class="btn btn-info" role="button">Volver</a>
        </div>
        <?php
        } 
        else {
          echo "Error: <br>".mysqli_error($conn);
        }?>

  </body>
</html>