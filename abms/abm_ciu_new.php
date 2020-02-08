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
  <?php session_start(); ?>
  <?php 
    include '../top.php';
    include '../fx.php';
    include '../seg_fx.php';
    include '../cn_con.php';
    include 'navig.php';


    //CERROJO: verificar si hay permisos
    if(!hay_permiso($_SESSION["id_rol"], "ci_ciudades", "A")){
                
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
      $ciudad = $_POST["ciudad"];
      $id_nivel = trim(explode("-", $_POST["id_nivel"])[0]);
      $id_provincia = trim(explode("-", $_POST["id_provincia"])[0]);

      $sql = "insert into ci_ciudades (ciudad, id_nivel, id_provincia) 
              values ('$ciudad', '$id_nivel', '$id_provincia')";

        if(mysqli_query($conn, $sql)){
            ?><br><div class="container">
            <div class="alert alert-success"><?php echo 'Alta exitosa de Ciudad';?></div>
            <a href="abm_ciu.php" class="btn btn-info" role="button">Volver</a></div><?php
        }
        else{
            ?><br><div class="container">
          <div class="alert alert-warning"><?php echo "Error: ".mysqli_error($conn);?></div>
          <a href="abm_ciu.php" class="btn btn-info" role="button">Volver</a>
          </div><?php
        }
        exit(); //no recarga form
    }
  ?>

    <div class="container">
      <h2>Form Registro Alta Ciudad</h2>
      <a href="abm_ciu.php" class="btn btn-info" role="button"> volver</a>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group">
          <label for="ciudad">Ciudad:</label>
          <input type="text" class="form-control" id="ciudad" placeholder="Ingrese Ciudad" name="ciudad" required>
        </div>
        <div class="form-group">
        <label for="id_provincia">Provincias:</label>
        <select class="form-control" id="id_provincia" name="id_provincia">
          <?php
            $provincias = provincias();
            while($p = mysqli_fetch_array($provincias)){
              $id_provincia = $p["id_provincia"];
              $provincia = $p["provincia"];
              echo '<option>'.$id_provincia.' - '.$provincia.'</option>';
            }?>
        </select>
        </div>
        <div class="form-group">
        <label for="id_nivel">Niveles:</label>
        <select class="form-control" id="id_nivel" name="id_nivel">
          <?php
            $niveles = niveles();
            while($n = mysqli_fetch_array($niveles)){
              $id_nivel = $n["id_nivel"];
              $nivel = $n["nivel"];
              echo '<option>'.$id_nivel.' - '.$nivel.'</option>';
            }?>
        </select>
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
      </form>
    </div>
  </body>
</html>