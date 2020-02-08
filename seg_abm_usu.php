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
    include 'top.php';
    include 'navig.php';
    include 'seg_fx.php';

    //CERROJO: verificar si hay permisos de consulta para ACCESO A USUARIOS
    if(!hay_permiso($_SESSION["id_rol"], "seg_usuarios", "C")){
        
      //  mensaje
      ?>
          <br><div class="container">
          <div class="alert alert-warning">No tiene permisos para esta accion!</div>
          <a href="index.php" class="btn btn-info" role="button">Volver</a>
      <?php 
      exit();
   }
   // fin CERROJO -----------------------------------------------------

    $usuarios = usuarios();
    ?>
    <div class="container">
    <br>
    <a href="seg_abm_usu_new.php" class="btn btn-info" role="button">Crear nuevo usuario</a>
        <h3>Lista de Usuarios</h3>
        <table class="table table-striped">
        <thead>
          <tr>
            <th>id</th>
            <th>usuario</th>
            <th>email</th>
            <th>rol</th>
            <th>estado</th>
          </tr>
        </thead>
        <tbody>
          <?php
            while($u = mysqli_fetch_array($usuarios)){
                $id_usuario = $u["id_usuario"];
                $usuario = $u["usuario"];
                $email = $u["email"];
                $rol = rol_usuario($id_usuario);
                $estado = $u["estado"];

                echo '<tr>
                <td>'.$id_usuario.'</td>
                <td>'.$usuario.'</td>
                <td>'.$email.'</td>
                <td>'.$rol.'</td>
                <td>'.$estado.'</td>
                <td><a href="seg_abm_usu_rol.php?id='.$id_usuario.'">rol</a></td>
                <td><a href="seg_abm_usu_modif.php?id='.$id_usuario.'">modif</a></td>
                <td><a href="seg_abm_usu_enviar.php?id='.$id_usuario.'">enviar</a></td>
                <td><a href="seg_abm_usu_remov.php?id='.$id_usuario.'">eliminar</a></td>
                </tr>';
            }
          ?>  
        </tbody>
      </table>
    </div>
    </body>
</html>