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
    include 'navig.php';
    ?>

    <div class="container">
    <br>
    <h2>Establecer Elemento</h2><br>
    <form method="post" action="estab_elem_.php">
        <div class="form-group">
          <label for="tipo_elemento">Seleccione un tipo:</label>
          <select class="form-control" id="tipo_elemento" name="tipo_elemento">
          <option>DIM - DIMENSIONES</option>
          <option>EJE - EJES</option>
          <option>FAC - FACTORES</option>
          <option>ITE - ITEMS</option>
          </select>
        </div>
      
        <button type="submit" class="btn btn-primary">Seleccionar</button>
      </form>
    </div>
  </body>
</html>