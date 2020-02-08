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

        //CERROJO: verificar si hay permisos consulta abm ejes 
        if(!hay_permiso($_SESSION["id_rol"], "ejes", "C")){
          
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
    <a href="abm_eje_new.php" class="btn btn-info" role="button">Nuevo Eje</a>
      <h3>Lista de Ejes</h3>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>id Dimension</th>
            <th>Dimension</th>
            <th>id Eje</th>
            <th>Eje</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $ejes = ejes();
            while($eje = mysqli_fetch_array($ejes)){
                $id_dimension = $eje["id_dimension"];
                $dimension = dimension($id_dimension)["dimension"];
                $id_eje = $eje["id_eje"];
                $eje = $eje["eje"];
                echo '<tr>
                <td>'.$id_dimension.'</td>
                <td>'.$dimension.'</td>
                <td>'.$id_eje.'</td>
                <td>'.$eje.'</td>
                <td><a href="abm_eje_modif.php?id='.$id_eje.'">modificar</a></td>
                <td><a href="abm_eje_remov.php?id='.$id_eje.'">eliminar</a></td>
                </tr>';
            }
          ?>
          
        </tbody>
      </table>
    </div>
  </body>
</html>
