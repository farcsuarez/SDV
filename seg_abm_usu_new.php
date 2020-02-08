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
    include 'cn_con.php';
    include 'navig.php';
    include 'seg_fx.php';

    //CERROJO: verificar si hay permisos ALTA USUARIO
    if(!hay_permiso($_SESSION["id_rol"], "seg_usuarios", "A")){
        
      //  mensaje
      ?>
          <br><div class="container">
          <div class="alert alert-warning">No tiene permisos para esta accion!</div>
      <?php 
      exit();
   }
   // fin CERROJO -----------------------------------------------------

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuario = $_POST["usuario"];
        $identidad_real = $_POST["real"];
        $email = $_POST["email"];
        $id_ciudad = trim(explode("-", $_POST["id_ciudad"])[0]);

        $sql = "insert into seg_usuarios
                (usuario, identidad_real, email, id_ciudad) values 
                ('$usuario', '$identidad_real', '$email', '$id_ciudad')";

        if(mysqli_query($conn, $sql)){
            ?><br><div class="container">
                    <div class="alert alert-success">Alta de usuario correcta!</div>
                    <a href="seg_abm_usu.php" class="btn btn-info" role="button">Usuarios</a>
                  </div><?php
        }
        else{
            ?><br><div class="container">
                <div class="alert alert-warning"><?php echo "Error: ".mysqli_error($conn);?></div>
                <a href="seg_abm_usu.php" class="btn btn-info" role="button">Volver</a>
          </div><?php
        }
        exit(); //no recarga form
    }
    ?>

    <div class="container">
      <h2>Form Registro Alta Usuario</h2>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group">
          <label for="usuario">Usuario (nick):</label>
          <input type="text" class="form-control" id="usuario" placeholder="Ingrese nick" name="usuario" required>
        </div>
        <div class="form-group">
          <label for="real">Nombre real -no obligatorio:</label>
          <input type="text" class="form-control" id="real" placeholder="nombre real" name="real">
        </div>
        <div class="form-group">
          <label for="email">Email -donde el usuario recibirá la contraseña:</label>
          <input type="email" class="form-control" id="email" placeholder="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="id_ciudad">Ciudad asociada -de corresponder a usuario final:</label>
          <select class="form-control" id="id_ciudad" name="id_ciudad">
            <option>0 - no corresponde</option>
            <?php
              $ciudades = ciudades();
              while($c = mysqli_fetch_array($ciudades)){
                $t = $c["id_ciudad"].' - '.$c["ciudad"];
                echo '<option>'.$t.'</option>';
              }
            ?>
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
      </form>
    </div>
  </body>
</html>