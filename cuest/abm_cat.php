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
      include 'navig.php';

      //CERROJO: verificar si hay permisos
      if(!hay_permiso($_SESSION["id_rol"], "it_categorias", "C")){
          
        //  mensaje
        ?>
            <br><div class="container">
            <div class="alert alert-warning">No tiene permisos para esta accion!</div>
            <a href="../index.php" class="btn btn-info" role="button"> volver</a>
        <?php 
        exit();
      }
      // fin CERROJO -----------------------------------------------------
?>

  <div class="container">
  <br>
  <a href="abm_cat_new.php" class="btn btn-info" role="button">Nueva Categoria</a>
    <h3>Lista de Categorias</h3>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>id Categoria</th>
          <th>Categoria</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $categs = categorias();
          while($c = mysqli_fetch_array($categs)){
              echo '<tr>
              <td>'.$c["id_categoria"].'</td>
              <td>'.$c["categoria"].'</td>
              <td><a href="abm_cat_modif.php?idcat='.$c["id_categoria"].'">modificar</a></td>
              <td><a href="abm_cat_remov.php?idcat='.$c["id_categoria"].'">eliminar</a></td>
              </tr>';
          }
        ?>
      </tbody>
    </table>
  </div>

  </body>
</html>

