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
    include '../seg_fx.php';
    include '../fx.php';
    include 'navig.php';

            //CERROJO: verificar si hay permisos modificacion ponderaciones
            if(!hay_permiso($_SESSION["id_rol"], "ponderaciones", "M")){
          
              //  mensaje
              ?>
                  <br><div class="container">
                  <div class="alert alert-warning">No tiene permisos para esta accion!</div>
                  <a href="../index.php" class="btn btn-info" role="button"> volver</a>
              <?php 
              exit();
            }
            // fin CERROJO -----------------------------------------------------
    

    if(!isset($_SESSION["id_nivel"])){?>
      <div class="container"><br>
          <div class="alert alert-warning">
            Se debe establecer un NIVEL.
        <a href="estab_nivel.php" class="btn btn-info" role="button">Establecer Nivel a Ponderar</a>
        </div>
        <?php exit; //salir y establecer Nivel para ponderar
    }?>

    <div class="container"><br>
      <div class="alert alert-success">
            Nivel establecido: <?php echo nivel($_SESSION["id_nivel"])["nivel"];?>
        <a href="estab_nivel.php" class="btn btn-info" role="button">Cambiar Nivel</a>
      </div>

      <!-- generar un form dinámico con dimensiones, ejes y factores : <form class="form-inline"-->
      <h2>Form de Ponderaciones</h2>
      <form action="abm_pon_act.php" method="post">
      <?php 
          $id_nivel = $_SESSION["id_nivel"];

          //listar dimensiones
          $dim = dimensiones();
          while($d=mysqli_fetch_array($dim)){
            $texto = 'Dimension: '.$d["id_dimension"].' - '.$d["dimension"];
            $p = ponderacion("DIM", $d["id_dimension"], $id_nivel); //traer ponderacion 
            echo'<input type="text" style="background-color:Burlywood;" name="G'.$d["id_dimension"].'" value="'.$texto.'" size="60" readonly>';
            echo'<input type="text" style="background-color:Burlywood;text-align:center" name="vG'.$d["id_dimension"].'" value="'.$p.'" size="5"><br>';
              
              //listar ejes de la dimension actual
              $ejes = ejes_dim($d["id_dimension"]);
              while($e = mysqli_fetch_array($ejes)){
                $texto = '&nbsp;&nbsp;&nbsp;Eje: '.$e["id_eje"].' - '.$e["eje"];
                $p = ponderacion("EJE", $e["id_eje"], $id_nivel); //traer ponderacion 
                echo'<input type="text" style="background-color:Beige;" name="E'.$e["id_eje"].'" value="'.$texto.'" size="60" readonly>';
                echo'<input type="text" style="background-color:Beige;text-align:center" name="vE'.$e["id_eje"].'" value="'.$p.'" size="5"><br>';

                  //listar factores del eje actual
                  $factores = factores_eje($e["id_eje"]);
                  while($f = mysqli_fetch_array($factores)){
                    $id_fac = $f["id_factor"];
                    $texto = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Factor: '.$f["id_factor"].' - '.$f["factor"];
                    $p = ponderacion("FAC", $f["id_factor"], $id_nivel); //traer ponderacion 
                    echo'<input type="text" name="F'.$f["id_factor"].'" value="'.$texto.'" size="60" readonly>';
                    echo'<input type="text" style="text-align:center" name="vF'.$f["id_factor"].'" value="'.$p.'" size="5">';
                    if(hay_items($id_fac)){
                      echo'<a href="abm_pon_items.php?id_factor='.$id_fac.'">&nbsp;&nbsp;Items&nbsp;&nbsp;</a><br>';
                    }
                    else{ echo '<br>';}
                  }
              }
          } ?>

        <input type="submit" value="enviar">
      </form>  
    </div>

  </body>
</html>