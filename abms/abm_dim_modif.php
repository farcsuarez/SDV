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

        //CERROJO: verificar si hay permisos modificar abm dimensiones 
        if(!hay_permiso($_SESSION["id_rol"], "dimensiones", "M")){
            
          //  mensaje
          ?>
              <br><div class="container">
              <div class="alert alert-warning">No tiene permisos para esta accion!</div>
              <a href="abm_dim.php" class="btn btn-info" role="button">Volver</a>
          <?php 
          exit();
        }
        // fin CERROJO -----------------------------------------------------

      $dimen = dimension($_GET["id"]);
    ?>

    <div class="container">
      <h2>Form Modificar Dimension</h2>
      <a href="abm_dim.php" class="btn btn-info" role="button">volver</a>
      <form method="post" action="abm_dim_modif_.php">
      <div class="form-group">
          <label for="id_dimension">Id Dimension:</label>
          <input type="text" class="form-control" id="id_dimension" 
            placeholder="Ingrese ID" name="id_dimension" value="<?php echo $_GET["id"];?>" readonly>
        </div>
        <div class="form-group">
          <label for="dimension">Dimension:</label>
          <input type="text" class="form-control" id="dimension" placeholder="Ingrese Dimension" 
                  name="dimension" value="<?php echo $dimen["dimension"];?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </form>
    </div>
  </body>
</html>