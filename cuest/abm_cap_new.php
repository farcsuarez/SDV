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
      if(!hay_permiso($_SESSION["id_rol"], "it_capas", "A")){
          
        //  mensaje
        ?>
            <br><div class="container">
            <div class="alert alert-warning">No tiene permisos para esta accion!</div>
            <a href="abm_cap.php" class="btn btn-info" role="button"> volver</a>
        <?php 
        exit();
      }
      // fin CERROJO -----------------------------------------------------
    ?>

    <div class="container">
      <h2>Form Registro Alta Capa</h2>
      <a href="abm_cap.php" class="btn btn-info" role="button"> volver</a>
      <form method="post" action="abm_cap_new_.php">
      <div class="form-group">
          <label for="capa">Capa:</label>
          <input type="text" class="form-control" id="capa" placeholder="Ingrese Capa" name="capa" required>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </form>
    </div>
  </body>
</html>
