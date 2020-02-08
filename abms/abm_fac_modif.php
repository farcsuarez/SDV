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

              //CERROJO: verificar si hay permisos modif factores 
              if(!hay_permiso($_SESSION["id_rol"], "factores", "M")){
          
                //  mensaje
                ?>
                    <br><div class="container">
                    <div class="alert alert-warning">No tiene permisos para esta accion!</div>
                    <a href="abm_fac.php" class="btn btn-info" role="button"> volver</a>
                <?php 
                exit();
              }
              // fin CERROJO -----------------------------------------------------
      

    $id_factor = $_GET["id"];
    $obj_fac = factor($id_factor);
    $factor = $obj_fac["factor"];
    $id_eje = $obj_fac["id_eje"];
    $obj_eje = eje($id_eje);
    $id_dimension = $obj_eje["id_dimension"];
    $dimension = dimension($id_dimension)["dimension"];
    $eje = $obj_eje["eje"];
    ?>
    <div class="container">
      <h2>Form Modifica Factores</h2>
      <a href="abm_fac.php" class="btn btn-info" role="button"> volver</a>
      <form method="post" action="abm_fac_modif_.php">
      <div class="form-group">
        <label for="eje_dimension">Dimensiones y Ejes:</label>
        <select class="form-control" id="eje_dimension" name="eje_dimension" readonly>
          <option><?php echo $id_dimension.' - '.$dimension.' - '.$id_eje.' - '.$eje;?></option>
        </select>
      </div>
      <div class="form-group">
          <label for="id_factor">Id Factor:</label>
          <input type="text" class="form-control" id="id_factor" placeholder="Ingrese ID" name="id_factor" value="<?php echo $id_factor;?>" readonly>
        </div>
        <div class="form-group">
          <label for="eje">Factor:</label>
          <input type="text" class="form-control" id="factor" placeholder="Ingrese Factor" name="factor" value="<?php echo $factor;?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </form>
    </div>
  </body>
</html>
