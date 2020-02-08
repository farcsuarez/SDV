<?php session_start(); ?>
<!DOCTYPE html>

<!-- envía una nueva contraseña al usuario y la almacena en la DB -->

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

    //CERROJO: verificar si hay permisos MODIFICACION USUARIO 
    if(!hay_permiso($_SESSION["id_rol"], "seg_usuarios", "M")){
        
        //  mensaje
        ?>
            <br><div class="container">
            <div class="alert alert-warning">No tiene permisos para esta accion!</div>
        <?php 
        exit();
     }
     // fin CERROJO -----------------------------------------------------


    $id_usuario = $_GET["id"];
    $arr_usu = usuario($id_usuario);
    $email = $arr_usu["email"];
    $usuario = $arr_usu["usuario"];
    $_SESSION["id_us_enviar"] = $id_usuario;
    $_SESSION["us_enviar"] = $usuario;
    $_SESSION["email"] = $email;

        //antes de generar y enviar la contraseña, verificar que el nuevo usuario
        //tenga un rol asignado
        if(!tiene_rol($id_usuario)){
            echo '<div class="container">';
            echo '<h5>El usuario no tiene roles asignados! antes de generar y enviar password, debe asignarse un rol.</h5>';
            echo '<a href="seg_abm_usu.php" class="btn btn-info" role="button">volver</a>';
            echo '</div>';
            exit();
        }
    ?>

        <div class="container">
            <br>


            <h4>Se generará una nueva contraseña y se la enviará al usuario por mail</h4>
            Usuario: <?php echo $usuario;?><br>
            email: <?php echo $email;?><hr>

            <a href="seg_abm_usu_enviar_.php" class="btn btn-info" role="button">generar y enviar</a>
            <hr>
            <a href="seg_abm_usu.php" class="btn btn-info" role="button">cancelar</a>
        </div>
    </body>
</html>