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
      $categoria = $_POST["categoria"];

      //almacenar nueva categoria ----------------------------
      $sql = "insert into it_categorias
              (categoria) values ('$categoria')";
      
          if (mysqli_query($conn, $sql)) {
           ?> 
           <br><div class="container">
              <div class="alert alert-success">
                <?php echo 'Alta exitosa de la categoría :'.$categoria;?>
              </div>
              <a href="abm_cat.php" class="btn btn-info" role="button">Listado</a>
              <a href="abm_cat_new.php" class="btn btn-info" role="button">Nueva Alta</a>
           </div>   
            <?php
          } 
          else {
            echo "Error: <br>".mysqli_error($conn);
          }?>

  </body>
</html>