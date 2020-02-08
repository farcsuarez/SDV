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


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_usuario = $_POST["id_usuario"];
        $usuario = $_POST["usuario"];
        $identidad_real = $_POST["real"];
        $email = $_POST["email"];
        $estado = $_POST["estado"];
        $id_ciudad = trim(explode("-", $_POST["id_ciudad"])[0]);

        $sql = "update seg_usuarios
                set usuario = '$usuario', identidad_real = '$identidad_real', 
                email = '$email', estado = '$estado', id_ciudad = '$id_ciudad'  
                where id_usuario = '$id_usuario'";

        if(mysqli_query($conn, $sql)){
            ?><br><div class="container">
                    <div class="alert alert-success">Modificacion de usuario correcta!</div>
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

    $id_usuario = $_GET["id"];
    $u = usuario($id_usuario);
    ?>

    <div class="container">
      <h2>Form Modifica Usuario</h2>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group">
          <label for="id_usuario">id Usuario:</label>
          <input type="text" class="form-control" id="id_usuario" placeholder="" name="id_usuario" 
            value="<?php echo $u["id_usuario"];?>" readonly>
        </div>
        <div class="form-group">
          <label for="usuario">Usuario (nick):</label>
          <input type="text" class="form-control" id="usuario" placeholder="Ingrese nick" name="usuario" 
            value="<?php echo $u["usuario"];?>"required>
        </div>
        <div class="form-group">
          <label for="real">Nombre real -no obligatorio:</label>
          <input type="text" class="form-control" id="real" placeholder="nombre real" name="real" 
            value="<?php echo $u["identidad_real"];?>">
        </div>
        <div class="form-group">
          <label for="email">Email -donde el usuario recibirá la contraseña:</label>
          <input type="email" class="form-control" id="email" placeholder="email" name="email" 
            value="<?php echo $u["email"];?>" required>
        </div>
        <div class="form-group">
          <label for="id_ciudad">Ciudad asociada -de corresponder a usuario final:</label>
          <select class="form-control" id="id_ciudad" name="id_ciudad">
            <?php $t = $u["id_ciudad"];
                  if($t == 0){
                    $t = '0 - no corresponde';
                  }else{
                    $t = $t.' - '.ciudad($t)["ciudad"];
                  }
              ?>
            <option><?php echo $t;?></option>
            <?php
              $ciudades = ciudades();
              while($c = mysqli_fetch_array($ciudades)){
                $t = $c["id_ciudad"].' - '.$c["ciudad"];
                echo '<option>'.$t.'</option>';
              }
            ?>
              <option>0 - no corresponde</option>
          </select>
        </div>
        <div class="form-group">
          <label for="estado">Estado:</label>
          <select class="form-control" id="estado" name="estado">
            <option><?php echo $u["estado"];?></option>
            <option>habilitado</option>
            <option>bloqueado</option>
          </select>  
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
      </form>
    </div>
  </body>
</html>