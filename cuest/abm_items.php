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
      include '../seg_fx.php';
      include 'navig.php';

            //CERROJO: verificar si hay permisos consulta items
            if(!hay_permiso($_SESSION["id_rol"], "items", "C")){
    
              //  mensaje
              ?>
                  <br><div class="container">
                  <div class="alert alert-warning">No tiene permisos para esta accion!</div>
                  <a href="../index.php" class="btn btn-info" role="button">Volver</a>
              <?php 
              exit();
            }
            // fin CERROJO -----------------------------------------------------
      
        //verificar que exista factor establecido, y traer items de ese factor
        //caso contrario, establecer factor
        if(!isset($_SESSION["id_factor"])){?>
            <div class="container"><br>
              <div class="alert alert-warning">
                Se debe establecer un FACTOR.
            <a href="establecer_factor.php" class="btn btn-info" role="button">Establecer Factor</a>
            </div>
            <?php exit; //salir y establecer factor
        }

        $id_factor = $_SESSION["id_factor"];
        $factor = factor($id_factor)["factor"];
        ?>

        <div class="container"><br>
        <div class="alert alert-success">
          <strong>Factor actual: </strong> <?php echo $id_factor.' - '.$factor;?>
          <a href="establecer_factor.php" class="btn btn-info" role="button">Cambiar Factor</a>
        </div>

        <a href="abm_items_new.php" class="btn btn-info" role="button">Nuevo Item</a>
          <h3>Lista de Items</h3>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>id item</th>
                <th>orden</th>
                <th>categoria</th>
                <th>tipo resp</th>
                <th>texto</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $items = items($id_factor);
                while($item = mysqli_fetch_array($items)){
                    $id_item = $item["id_item"];
                    $nro_orden = $item["nro_orden"]; 
                    $categoria = categoria($item["id_categoria"]); 
                    $tipo_resp = $item["tipo_resp"]; 
                    $desc = $item["descripcion"]; 
                    $texto = $item["texto"]; 
                    echo '<tr>
                    <td>'.$id_item.'</td>
                    <td>'.$nro_orden.'</td>
                    <td>'.$categoria.'</td>
                    <td>'.$tipo_resp.'</td>
                    <td>'.$texto.'</td>
                    <td><a href="abm_items_modif.php?id='.$id_item.'">modif</a></td>
                    <td><a href="abm_items_remov.php?id='.$id_item.'">elim</a></td>
                    </tr>';
                }
              ?>
            </tbody>
          </table>
        </div>

  </body>
</html>