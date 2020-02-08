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

      $_SESSION["id_factor"] = explode("-",$_POST["factor"])[2];
      $id_factor = $_SESSION["id_factor"];
      $factor = factor($id_factor)["factor"];
      ?><br>
        <div class="container">
        <div class="alert alert-success"><strong><?php echo 'Factor actual : '.$id_factor.' - '.$factor;?></strong></div>
        <a href="abm_items.php" class="btn btn-info" role="button">ABM Items</a>
        </div>

  </body>
</html>

