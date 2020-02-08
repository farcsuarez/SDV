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

      //CERROJO: verificar si hay permisos consulta abm dimensiones 
      if(!hay_permiso($_SESSION["id_rol"], "dimensiones", "C")){
          
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
    <a href="abm_dim_new.php" class="btn btn-info" role="button">Nueva Dimension</a>
      <h3>Lista de Dimensiones</h3>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>id Dimension</th>
            <th>Dimension</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $dimen = dimensiones();
            while($d = mysqli_fetch_array($dimen)){
                echo '<tr>
                <td>'.$d["id_dimension"].'</td>
                <td>'.$d["dimension"].'</td>
                <td><a href="abm_dim_modif.php?id='.$d["id_dimension"].'">modificar</a></td>
                <td><a href="abm_dim_remov.php?id='.$d["id_dimension"].'">eliminar</a></td>
                </tr>';
            }
          ?>
        </tbody>
      </table>
    </div>

  </body>
</html>