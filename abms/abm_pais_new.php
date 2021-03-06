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
    include '../cn_con.php';
    include '../seg_fx.php';
    include 'navig.php';

    //CERROJO: verificar si hay permisos
    if(!hay_permiso($_SESSION["id_rol"], "ci_pais", "A")){
              
      //  mensaje
      ?>
          <br><div class="container">
          <div class="alert alert-warning">No tiene permisos para esta accion!</div>
          <a href="abm_pais.php" class="btn btn-info" role="button"> volver</a>
      <?php 
      exit();
    }
    // fin CERROJO -----------------------------------------------------

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $pais = $_POST["pais"];
        $sql = "insert into ci_pais (pais) values ('$pais')";
        if(mysqli_query($conn, $sql)){
            ?><br><div class="container">
            <div class="alert alert-success">
            <strong><?php echo 'Alta exitosa de Pais';?></strong> 
            </div>
            <a href="abm_pais.php" class="btn btn-info" role="button">Volver</a>
            </div><?php
        }
        else{
            ?><br><div class="container">
          <div class="alert alert-warning"><strong><?php echo "Error: ".mysqli_error($conn);?></strong></div>
          <a href="abm_pais.php" class="btn btn-info" role="button">Volver</a>
          </div><?php
        }
        exit(); //no recarga form
    }
    ?>

    <div class="container">
      <h2>Form Registro Alta Pais</h2>
      <a href="abm_pais.php" class="btn btn-info" role="button"> volver</a>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group">
          <label for="pais">Pais:</label>
          <input type="text" class="form-control" id="pais" placeholder="Ingrese Pais" name="pais" required>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </form>
    </div>
  </body>
</html>