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
    include '../fx.php';
    include '../top.php';
    include 'navig.php';
    ?>

    <div class="container">
    <br>
    <h2>Establecer Nivel</h2><br>
    <form method="post" action="estab_nivel_.php">
        <div class="form-group">
          <label for="tipo_elemento">Seleccione un NIVEL:</label>
          <select class="form-control" id="id_nivel" name="id_nivel">
          <?php 
              $niveles = niveles();
              while($nivel = mysqli_fetch_array($niveles)){
                  echo'<option>'.$nivel["id_nivel"].' - '.$nivel["nivel"].'</option>';
              }
          ?>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Seleccionar</button>
    </form>
    </div>
  </body>
</html>