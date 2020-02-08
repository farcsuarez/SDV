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
    if(!hay_permiso($_SESSION["id_rol"], "ci_ciudades", "C")){
                
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
    <a href="abm_ciu_new.php" class="btn btn-info" role="button">Nueva Ciudad</a>
      <h3>Lista de Ciudades</h3>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>id Ciudad</th>
            <th>Ciudad</th>
            <th>Prov/Estado</th>
            <th>Pais</th>
            <th>Nivel</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $ciudades = ciudades();
            while($c = mysqli_fetch_array($ciudades)){
                $id_ciudad = $c["id_ciudad"];
                $ciudad = $c["ciudad"];
                $nivel = nivel($c["id_nivel"])["nivel"];
                $obj_prov = provincia($c["id_provincia"]);
                $provincia = $obj_prov["provincia"];
                $pais = pais($obj_prov["id_pais"])["pais"];
                echo '<tr>
                <td>'.$id_ciudad.'</td>
                <td>'.$ciudad.'</td>
                <td>'.$provincia.'</td>
                <td>'.$pais.'</td>
                <td>'.$nivel.'</td>
                <td><a href="../cuest/establecer_ciudad.php?id='.$id_ciudad.'">establecer</a></td>
                <td><a href="abm_ciu_modif.php?id='.$id_ciudad.'">modificar</a></td>
                <td><a href="abm_ciu_remov.php?id='.$id_ciudad.'">eliminar</a></td>
                </tr>';
            }
          ?>
        </tbody>
      </table>
    </div>
  </body>
</html>
