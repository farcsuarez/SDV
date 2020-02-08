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
      include 'navig.php';
      include '../cn_con.php';

      //CERROJO: verificar si hay permisos eliminar items
      if(!hay_permiso($_SESSION["id_rol"], "items", "B")){

        //  mensaje
        ?>
            <br><div class="container">
            <div class="alert alert-warning">No tiene permisos para esta accion!</div>
        <?php 
        exit();
      }
      // fin CERROJO -----------------------------------------------------

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          if($_POST["confirma"] == 'NO'){
            ?><br><div class="container">
              <div class="alert alert-success">No hubo cambios</div>
              <a href="abm_items.php" class="btn btn-info" role="button">Volver</a>
            </div><?php
            exit();
          }

          //eliminar item y sus dependencias
          $id_item = trim(explode("-", $_POST["id_item"])[0]);
          if(del_item($id_item)){
            ?><br><div class="container">
            <div class="alert alert-success">Se eliminó con exito el item</div>
              <a href="abm_items.php" class="btn btn-info" role="button">Volver</a>
            </div><?php
          }
          else{
              ?><br><div class="container">
            <div class="alert alert-warning"><?php echo "Error: ".mysqli_error($conn);?></div>
              <a href="abm_items.php" class="btn btn-info" role="button">Volver</a>
            </div><?php
          }
        
          exit(); //no recarga form
      }
      $item = item($_GET["id"]);
      ?> 

      <div class="container"><br>
        <h2>Confirma eliminación del ITEM?</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group">
            <label for="id_item">Item a eliminar:</label>
            <input type="text" class="form-control" id="id_item" placeholder="" name="id_item" 
            value="<?php echo $item["id_item"].' - '.$item["texto"]; ?>" readonly>
          </div>
          <div class="form-group">
            <label for="confirma">Confirmar por Sí o No:</label>
            <select class="form-control" id="confirma" name="confirma">
              <option>NO</option>
              <option>SI</option>
            </select>
          </div>        
          <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
      </div>

  </body>
</html>