<?php session_start(); ?>
<!DOCTYPE html>

<!-- LOGIN de usuario -->

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
        include 'seg_fx.php'; 
        include 'cn_con.php'; 

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario = ($_POST["usuario"]);
            $pass = ($_POST["pwd"]);

            //traer password y estado del usuario desde la DB
            $arr_usu = pass($usuario);
            $pass_almacenada = $arr_usu["pass"];
            $estado = $arr_usu["estado"];
            $id_usuario = $arr_usu["id_usuario"];
            $id_ciudad =  $arr_usu["id_ciudad"];

            if(password_verify($pass, $pass_almacenada)){
                //password correcto, verificar si está bloqueado
                if($estado == 'bloqueado'){
                    ?>
                    <div class="alert alert-danger"><strong>Su usuario esta BLOQUEADO</strong></div>
                    <?php exit();
                }
                
                //establecer sesion de user_log para habilitarlo, su rol y su id
                $_SESSION["user_log"] = $usuario; //user_log es equivalente a usuario (nick)
                $_SESSION["id_usuario"] = $id_usuario;

                //establecer sesion con rol
                $id_rol = rol_usu($id_usuario);
                $_SESSION["id_rol"] = $id_rol;
                $txt = rol($id_rol)["rol"];

                //registrar su ingreso
                $sql_log = "insert into log_login
                            (id_usuario, id_rol) values ('$id_usuario', '$id_rol')";
                mysqli_query($conn, $sql_log);

                //almacena nombre de rol para visualizar junto a session[user_log]
                $_SESSION["user_log_rol"] = $txt;

                //asociar ciudad asignada al usuario, de corresponder (usuarios finales)
                if($id_ciudad != 0){
                    $_SESSION["id_ciudad"] = $id_ciudad;
                }

                ?>  <br><br>
                    <div class="container d-flex flex-column">
                        <div class="alert alert-primary">Login correcto!</div>
                        <a href="index.php" class="btn btn-info" role="button">ir al HOME</a>
                    </div>
                <?php
            }else{
                    //fallo de login
                ?>
                    <div class="alert alert-danger"><strong>FALLO de Login!</strong></div>
                        <div class="container d-flex flex-column">
                        <a href="seg_login.php" class="btn btn-info" role="button">ir al Login</a>
                    </div>
                <?php
            }
            exit();          
        }     
    ?> 
               
    <div class="container">
    <br>
    <h2>Login Form</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <br><div class="form-group">
            <label for="usuario">Usuario:</label>
            <input type="text" class="form-control" id="usuario" placeholder="su usuario" name="usuario" required>
            </div>
            <br><div class="form-group">
            <label for="pwd">Password asignada:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" required>
            </div>
            <!--
            <div class="form-group form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="remember"> Remember me
            </label>
            </div>
            -->
            <br><button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
    </body>
</html>