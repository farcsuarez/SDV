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
    include '../cn_con.php';
    include 'navig.php';

    //CERROJO: verificar si hay permisos
    if(!hay_permiso($_SESSION["id_rol"], "ci_ciudades", "M")){
                
      //  mensaje
      ?>
          <br><div class="container">
          <div class="alert alert-warning">No tiene permisos para esta accion!</div>
          <a href="abm_ciu.php" class="btn btn-info" role="button"> volver</a>
      <?php 
      exit();
    }
    // fin CERROJO -----------------------------------------------------


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_ciudad = $_POST["id_ciudad"];
        $ciudad = $_POST["ciudad"];
        $id_nivel = trim(explode("-", $_POST["id_nivel"])[0]);
        $id_provincia = trim(explode("-", $_POST["id_provincia"])[0]);

        $sql = "update ci_ciudades set ciudad = '$ciudad', id_nivel = '$id_nivel', id_provincia = '$id_provincia'
                where id_ciudad = '$id_ciudad'";

        if(mysqli_query($conn, $sql)){
            ?><br><div class="container">
            <div class="alert alert-success"><?php echo 'Modificacion exitosa de Ciudad';?></div>
            <a href="abm_ciu.php" class="btn btn-info" role="button">Volver</a></div><?php
        }
        else{
            ?><br><div class="container">
          <div class="alert alert-warning"><?php echo "Error: ".mysqli_error($conn);?></div>
          <a href="abm_ciu.php" class="btn btn-info" role="button">Volver</a></div><?php
        }
        exit(); //no recarga form
    }

    $id_ciudad = $_GET["id"];
    $obj_ciu = ciudad($id_ciudad);
    $ciudad = $obj_ciu["ciudad"];
    $id_nivel = $obj_ciu["id_nivel"];
    $nivel = nivel($id_nivel)["nivel"];
    $niveles = niveles();
    $id_provincia = $obj_ciu["id_provincia"];
    $provincia = provincia($id_provincia)["provincia"];
    $provincias = provincias();
    ?>

    <div class="container">
      <h2>Form Modificar Ciudad</h2>
      <a href="abm_ciu.php" class="btn btn-info" role="button"> volver</a>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group">
          <label for="id_ciudad">id ciudad:</label>
          <input type="text" class="form-control" id="id_ciudad" placeholder="" name="id_ciudad" 
          value = "<?php echo $id_ciudad; ?>" readonly>
        </div>
        <div class="form-group">
          <label for="ciudad">ciudad:</label>
          <input type="text" class="form-control" id="ciudad" placeholder="" name="ciudad" 
          value = "<?php echo $ciudad; ?>" required>
        </div>
        <div class="form-group">
          <label for="id_provincia">Provincia:</label>
          <select class="form-control" id="id_provincia" name="id_provincia" >
            <option><?php echo $id_provincia.' - '.$provincia; ?></option>
            <?php
                while($p = mysqli_fetch_array($provincias)){
                  echo '<option>'.$p["id_provincia"].' - '.$p["provincia"].'</option>';
                }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="id_nivel">Nivel:</label>
          <select class="form-control" id="id_nivel" name="id_nivel" >
            <option><?php echo $id_nivel.' - '.$nivel; ?></option>
            <?php
                while($n = mysqli_fetch_array($niveles)){
                  echo '<option>'.$n["id_nivel"].' - '.$n["nivel"].'</option>';
                }
            ?>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </form>
    </div>
  </body>
</html>