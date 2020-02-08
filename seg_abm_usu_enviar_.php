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
        include 'top.php';
        include 'navig.php';
        include 'seg_fx.php';

        //generar contraseña, almacenarla en la DB y enviarla al mail del usuario
        $id_usuario = $_SESSION["id_us_enviar"];
        $c = gen_password();
        
        //grabar en DB con encriptacion blowfish
        salvar_pass(password_hash($c, PASSWORD_DEFAULT), $id_usuario);

        $email = $_SESSION["email"];
        $usuario = $_SESSION["us_enviar"];

        $titulo = "SDV activacion usuario";
        $mensaje = "Este es un mensaje de SDV\r\nSe le ha asignado un password de acceso, conservela en un lugar seguro, solo usted la conoce.\r\nSu password es: $c\r\nSu usuario es: $usuario";
        $mensaje = wordwrap($mensaje, 70, "\r\n");
        $cabeceras = 'From: webmaster@sdv.com' . "\r\n" .
                        'Reply-To: webmaster@sdv.com' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();

        // Enviarlo
        mail($email, $titulo, $mensaje, $cabeceras);
                ?><br><div class="container">
                        <div class="alert alert-success">Se ha enviado la nueva contraseña por email</div>
                        <a href="seg_abm_usu.php" class="btn btn-info" role="button">Volver</a>
                      </div><?php
        ?>
    </body>
</html>