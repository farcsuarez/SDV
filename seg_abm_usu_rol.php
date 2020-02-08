<?php session_start(); ?>
<!DOCTYPE html>

<!-- asigna rol a un usuario -->

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
    include 'cn_con.php';
    include 'seg_fx.php';

    //CERROJO: verificar si hay permisos MODIFICACION USUARIO - ROL
    if(!hay_permiso($_SESSION["id_rol"], "seg_usuario_rol", "M")){
        
        //  mensaje
        ?>
            <br><div class="container">
            <div class="alert alert-warning">No tiene permisos para esta accion!</div>
        <?php 
        exit();
     }
     // fin CERROJO -----------------------------------------------------


    $roles = roles(); //lista de roles
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_usuario = $_POST["id_usuario"];
        $id_rol = $_POST["rad"];
        
        del_roles_usuario($id_usuario); //elimina roles del usuario
            
        //registrar actividad -log 
        $sql_log = "insert into log_user_roles
                    (id_usuario, id_rol) values
                    ('$id_usuario', '$id_rol')";
        mysqli_query($conn, $sql_log);

        //grabar rol-user
        $sql = "insert into seg_usuario_rol
        (id_usuario, id_rol) values ('$id_usuario', '$id_rol')";
        
        if(mysqli_query($conn, $sql)){
            //asigna rol al usuario
            ?><br><div class="container">
            <div class="alert alert-success">Roles del Usuario actualizados!</div>
            <a href="seg_abm_usu.php" class="btn btn-info" role="button">Usuarios</a>
            </div><?php
        }else{
            ?><br><div class="container">
            <div class="alert alert-warning"><?php echo "Error: ".mysqli_error($conn);?></div>
            <a href="seg_abm_usu.php" class="btn btn-info" role="button">Volver</a></div><?php
        }
        exit();
    }

    $id_usuario = $_GET["id"];
    $usuario = usuario($id_usuario)["usuario"];
    ?>
        <div class="container"><br>
            <h3>Asignar Rol a Usuario: <?php echo $usuario; ?></h3><br>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                id usuario:<br>
                <input type="text" name="id_usuario" value="<?php echo $id_usuario; ?>" size="5" readonly><br><br>
                <?php
                //imprimir radio buttons con todos los roles
                while($r = mysqli_fetch_array($roles)){
                    $id_rol = $r["id_rol"];
                    if(existe_rol($id_usuario, $id_rol)){ //marcar checkbox
                        echo '<input type="radio" name="rad" value="'.$id_rol.'" checked>'.$r["rol"].'<br>';
                    }else{
                        echo '<input type="radio" name="rad" value="'.$id_rol.'">'.$r["rol"].'<br>';
                    }
                }
                ?><br>
                <button type="submit">enviar</button>
            </form>
        </div>
    </body>
</html>