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

    //CERROJO: verificar si hay permisos para modificar rol
    if(!hay_permiso($_SESSION["id_rol"], "seg_roles", "M")){
        
      //  mensaje
      ?>
          <br><div class="container">
          <div class="alert alert-warning">No tiene permisos para esta accion!
              <a href="seg_abm_rol.php" class="btn btn-info" role="button"> volver</a></div>
          </div>
      <?php 
      exit();
   }
   // fin CERROJO -----------------------------------------------------

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_rol = $_POST["id_rol"];
        $rol = $_POST["rol"];

        $sql = "update seg_roles set rol = '$rol'
                where id_rol = '$id_rol'";
        if(mysqli_query($conn, $sql)){
            ?><br><div class="container">
                    <div class="alert alert-success">Modificacion exitosa de Rol</div>
                    <a href="seg_abm_rol.php" class="btn btn-info" role="button">Volver</a>
                  </div><?php
        }
        else{
            ?><br><div class="container">
                    <div class="alert alert-warning"><strong><?php echo "Error: ".mysqli_error($conn);?></strong></div>
                    <a href="seg_abm_rol.php" class="btn btn-info" role="button">Volver</a>
                  </div><?php
        }
        exit(); //no recarga form
    }

    $id_rol = $_GET["id"];
    $rol = rol($id_rol)["rol"];
    ?>

    <div class="container">
      <h2>Form Registro Alta Rol</h2>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group">
          <label for="id_rol">id Rol:</label>
          <input type="text" class="form-control" id="id_rol" placeholder="" name="id_rol" 
                    value="<?php echo $id_rol;?>" readonly>
        </div>
        <div class="form-group">
          <label for="rol">Rol:</label>
          <input type="text" class="form-control" id="rol" placeholder="Ingrese Rol" name="rol" 
                value="<?php echo $rol;?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </form>
    </div>
    </body>
</html>