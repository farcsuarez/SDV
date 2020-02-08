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
    if(!hay_permiso($_SESSION["id_rol"], "ci_pais", "M")){
              
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
        $id_pais = $_POST["id_pais"];
        $pais = $_POST["pais"];
        $sql = "update ci_pais set pais = '$pais'
                where id_pais = '$id_pais'";

        if(mysqli_query($conn, $sql)){
            ?><br><div class="container">
            <div class="alert alert-success">
            <strong><?php echo 'Modificacion exitosa de Pais';?></strong></div>
            <a href="abm_pais.php" class="btn btn-info" role="button">Volver</a></div><?php
        }
        else{
            ?><br><div class="container">
          <div class="alert alert-warning"><strong><?php echo "Error: ".mysqli_error($conn);?></strong></div>
          <a href="abm_pais.php" class="btn btn-info" role="button">Volver</a></div><?php
        }
        exit(); //no recarga form
    }

    $id_pais = $_GET["id"];
    $pais = pais($id_pais)["pais"];
    ?>

    <div class="container">
      <h2>Form Modificar Pais</h2>
      <a href="abm_pais.php" class="btn btn-info" role="button"> volver</a>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="form-group">
          <label for="id_pais">id Pais:</label>
          <input type="text" class="form-control" id="id_pais" placeholder="" 
            name="id_pais" value="<?php echo $id_pais; ?>" readonly>
        </div>
        <div class="form-group">
          <label for="pais">Pais:</label>
          <input type="text" class="form-control" id="pais" placeholder="" name="pais" 
          value = "<?php echo $pais; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </form>
    </div>
  </body>
</html>