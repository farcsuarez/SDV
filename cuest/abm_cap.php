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
        if(!hay_permiso($_SESSION["id_rol"], "it_capas", "C")){
          
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
    <a href="abm_cap_new.php" class="btn btn-info" role="button">Nueva Capa</a>
      <h3>Lista de Capas</h3>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>id Capa</th>
            <th>Capa</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $capas = capas();
            while($c = mysqli_fetch_array($capas)){
                echo '<tr>
                <td>'.$c["id_capa"].'</td>
                <td>'.$c["capa"].'</td>
                <td><a href="abm_cap_modif.php?idcap='.$c["id_capa"].'">modificar</a></td>
                <td><a href="abm_cap_remov.php?idcap='.$c["id_capa"].'">eliminar</a></td>
                </tr>';
            }
          ?>
        </tbody>
      </table>
    </div>
  </body>
</html>