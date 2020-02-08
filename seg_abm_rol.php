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

    //CERROJO: verificar si hay permisos de consulta para ACCESO A ROLES
    if(!hay_permiso($_SESSION["id_rol"], "seg_roles", "C")){
        
        //  mensaje
        ?>
            <br><div class="container">
            <div class="alert alert-warning">No tiene permisos para esta accion!</div>
            <a href="index.php" class="btn btn-info" role="button"> volver</a>
        <?php 
        exit();
     }
     // fin CERROJO -----------------------------------------------------

    $roles = roles();
    ?>
    <div class="container">
        <h3>Lista de Roles</h3>
        <br>
        <a href="seg_abm_rol_new.php" class="btn btn-info" role="button">Nuevo ROL</a>
        <table class="table table-striped">
        <thead>
          <tr>
            <th>id Rol</th>
            <th>Rol</th>
          </tr>
        </thead>
        <tbody>
          <?php
            while($r = mysqli_fetch_array($roles)){
                $id_rol = $r["id_rol"];
                $rol = $r["rol"];

                echo '<tr>
                <td>'.$id_rol.'</td>
                <td>'.$rol.'</td>
                <td><a href="seg_permisos_rol.php?id='.$id_rol.'">permisos</a></td>
                <td><a href="seg_abm_rol_modif.php?id='.$id_rol.'">modificar</a></td>
                <td><a href="seg_abm_rol_remov.php?id='.$id_rol.'">eliminar</a></td>
                </tr>';
            }
          ?>  
        </tbody>
      </table>
    </div>
    </body>
</html>