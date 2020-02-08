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
        if(!hay_permiso($_SESSION["id_rol"], "it_unidades", "C")){
          
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

      <div class="container"><br>
      <a href="abm_uni_new.php" class="btn btn-info" role="button">Nueva Unidad</a>
        <h3>Lista de Unidades</h3>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>id Unidad</th>
              <th>tipo</th>
              <th>unidad</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $uni = unidades();
              while($u = mysqli_fetch_array($uni)){
                  echo '<tr>
                  <td>'.$u["id_unidad"].'</td>
                  <td>'.$u["tipo"].'</td>
                  <td>'.$u["unidad"].'</td>
                  <td><a href="abm_uni_modif.php?id='.$u["id_unidad"].'">modificar</a></td>
                  <td><a href="abm_uni_remov.php?id='.$u["id_unidad"].'">eliminar</a></td>
                  </tr>';
              }
            ?>
          </tbody>
        </table>
      </div>

  </body>
</html>