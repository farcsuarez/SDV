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
    include '../cn_con.php';
    include 'navig.php';
    $id_categoria = $_POST["id_categoria"];
    $categoria = $_POST["categoria"];

    //update categoria ----------------------------
    $sql = "update it_categorias
            set categoria = '$categoria' 
            where id_categoria = '$id_categoria'";

      if (mysqli_query($conn, $sql)) {
        ?> 
        <br><div class="container">
        <div class="alert alert-success">
          <?php echo 'Modificacion exitosa de la categoria '.$categoria;?></div>
        <a href="abm_cat.php" class="btn btn-info" role="button">Volver</a>
        </div>
      <?php
      } 
      else {
        echo "Error: <br>".mysqli_error($conn);
      }?>

  </body>
</html>
