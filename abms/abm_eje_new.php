<?php session_start();?>
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

        //CERROJO: verificar si hay permisos alta abm ejes 
        if(!hay_permiso($_SESSION["id_rol"], "ejes", "A")){
          
          //  mensaje
          ?>
              <br><div class="container">
              <div class="alert alert-warning">No tiene permisos para esta accion!</div>
              <a href="abm_eje.php" class="btn btn-info" role="button">Volver</a>
          <?php 
          exit();
        }
        // fin CERROJO -----------------------------------------------------
  ?>

    <div class="container">
      <h2>Form Registro Alta Eje</h2>
      <a href="abm_eje.php" class="btn btn-info" role="button">Volver</a>
      <form method="post" action="abm_eje_new_.php">
      <div class="form-group">
        <label for="id_dimension">Dimensiones:</label>
        <select class="form-control" id="id_dimension" name="id_dimension">
          <?php 
          $di = dimensiones();
          while($d = mysqli_fetch_array($di)){
              echo '<option>'.$d["id_dimension"].' - '.$d["dimension"].'</option>';
          }?>
        </select>
      </div>
      <div class="form-group">
          <label for="id_eje">Id Eje:</label>
          <input type="text" class="form-control" id="id_eje" placeholder="Ingrese ID" name="id_eje" required>
        </div>
        <div class="form-group">
          <label for="eje">Eje:</label>
          <input type="text" class="form-control" id="eje" placeholder="Ingrese Eje" name="eje" required>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </form>
    </div>
  </body>
</html>
