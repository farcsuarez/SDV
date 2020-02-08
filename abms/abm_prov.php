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
      if(!hay_permiso($_SESSION["id_rol"], "ci_provincias", "C")){
                
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
    <a href="abm_prov_new.php" class="btn btn-info" role="button">Nueva Prov/Estado</a>
      <h3>Lista de Prov/Estados</h3>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>id</th>
            <th>Prov/Estado</th>
            <th>Pais</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $provincias = provincias();
            while($p = mysqli_fetch_array($provincias)){
                $id_provincia = $p["id_provincia"];
                $provincia = $p["provincia"];
                $pais = pais($p["id_pais"])["pais"];
                echo '<tr>
                <td>'.$id_provincia.'</td>
                <td>'.$provincia.'</td>
                <td>'.$pais.'</td>
                <td><a href="abm_prov_modif.php?id='.$id_provincia.'">modificar</a></td>
                <td><a href="abm_prov_remov.php?id='.$id_provincia.'">eliminar</a></td>
                </tr>';
            }
          ?>
          
        </tbody>
      </table>
    </div>
  </body>
</html>
