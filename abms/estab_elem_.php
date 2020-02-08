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
      include 'navig.php';
      $_SESSION["tipo_elemento"] = $_POST["tipo_elemento"];
    ?>

    <br>
      <div class="container">
      <div class="alert alert-success"><?php echo 'Tipo establecido : '.$_SESSION["tipo_elemento"];?></div>
      <a href="abm_pon.php" class="btn btn-info" role="button">Ponderaciones</a>
      </div>
  </body>
</html>