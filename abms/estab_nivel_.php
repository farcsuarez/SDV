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
    $_SESSION["id_nivel"] = trim(explode("-", $_POST["id_nivel"])[0]);
    $nivel = nivel($_SESSION["id_nivel"]); 
    ?>

    <br>
      <div class="container">
      <div class="alert alert-success"><?php echo 'Nivel establecido : '
        .$_SESSION["id_nivel"].' - '.$nivel["nivel"];?></div>
      <a href="abm_pon.php" class="btn btn-info" role="button">Ponderaciones</a>
      </div>
  </body>
</html>