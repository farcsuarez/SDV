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

        //CERROJO: verificar si hay permisos consulta factores 
        if(!hay_permiso($_SESSION["id_rol"], "factores", "C")){
          
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
    <a href="abm_fac_new.php" class="btn btn-info" role="button">Nuevo Factor</a>
      <h3>Lista de Factores</h3>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>id Dimension</th>
            <th>Dimension</th>
            <th>id Eje</th>
            <th>Eje</th>
            <th>id Factor</th>
            <th>Factor</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $factores = factores();
            while($obj_fac = mysqli_fetch_array($factores)){
                $id_eje = $obj_fac["id_eje"];
                $factor = $obj_fac["factor"];
                $id_factor = $obj_fac["id_factor"];
                $obj_eje = eje($id_eje);
                $eje = $obj_eje["eje"];
                $id_dimension = $obj_eje["id_dimension"];
                $obj_dim = dimension($id_dimension);
                $dimension = $obj_dim["dimension"];

                echo '<tr>
                <td>'.$id_dimension.'</td>
                <td>'.$dimension.'</td>
                <td>'.$id_eje.'</td>
                <td>'.$eje.'</td>
                <td>'.$id_factor.'</td>
                <td>'.$factor.'</td>
                <td><a href="abm_fac_modif.php?id='.$id_factor.'">modificar</a></td>
                <td><a href="abm_fac_remov.php?id='.$id_factor.'">eliminar</a></td>
                </tr>';
            }
          ?>
          
        </tbody>
      </table>
    </div>
  </body>
</html>