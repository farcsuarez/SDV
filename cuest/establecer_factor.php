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
      include '../fx.php';
      include '../top.php';
      include 'navig.php';
  ?>

    <div class="container">
      <h2>Seleccionar FACTOR asociado</h2>
      <form method="post" action="establecer_factor_.php">
        <div class="form-group">
          <label for="factor">Factores:</label>
          <select class="form-control" id="factor" name="factor">
            <?php 
            $factores = factores();
            while($factor = mysqli_fetch_array($factores)){
              $id_factor = $factor["id_factor"];
              $id_eje = $factor["id_eje"];
              $factor = $factor["factor"];
              $obj_eje = eje($id_eje);
              $id_dimension = $obj_eje["id_dimension"];
              $eje = $obj_eje["eje"];
              $dimension = dimension($id_dimension)["dimension"];
              echo '<option>'.$dimension.' - '.$eje.' - '.$id_factor.' - '.$factor.'</option>';
            }?>
          </select>
        </div>
      
        <button type="submit" class="btn btn-primary">Seleccionar</button>
      </form>
    </div>    
    
  </body>
</html>