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
      if(!hay_permiso($_SESSION["id_rol"], "ci_pais", "C")){
              
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
    <a href="abm_pais_new.php" class="btn btn-info" role="button">Nuevo Pais</a>
      <h3>Lista de Paises</h3>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>id Pais</th>
            <th>Pais</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $paises = paises();
            while($obj_p = mysqli_fetch_array($paises)){
                $id_pais = $obj_p["id_pais"];
                $pais = $obj_p["pais"];

                echo '<tr>
                <td>'.$id_pais.'</td>
                <td>'.$pais.'</td>
                <td><a href="abm_pais_modif.php?id='.$id_pais.'">modificar</a></td>
                <td><a href="abm_pais_remov.php?id='.$id_pais.'">eliminar</a></td>
                </tr>';
            }
          ?>  
        </tbody>
      </table>
    </div>
  </body>
</html>