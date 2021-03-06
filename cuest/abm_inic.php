<?php session_start();?>
<!DOCTYPE html>

<!-- Lista general de acceso a Iniciativas por FACTORES -->

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

    //CERROJO: verificar si hay permisos para iniciativas
    if(!hay_permiso($_SESSION["id_rol"], "in_iniciativas", "C")){

      //  mensaje
      ?>
          <br><div class="container">
          <div class="alert alert-warning">No tiene permisos para esta accion!</div>
          <a href="../index.php" class="btn btn-info" role="button">Volver</a>
      <?php 
      exit();
    }
    // fin CERROJO -----------------------------------------------------

      if(!isset($_SESSION["id_ciudad"])){
        ?>
          <div class="container"><br>
            <div class="alert alert-warning">
              Se debe establecer una CIUDAD.
          </div>
        <?php exit; //salir y establecer ciudad
      }
    ?>

    <div class="container"><br>

    <h2>INICIATIVAS: seleccione FACTOR</h2>
      <!-- generar una tabla dinámico con dimensiones, ejes y factores -->
      
    <table class="table">
        <thead>
        <tr>
            <th>dimensiones</th>
            <th>ejes</th>
            <th>factores</th>
        </tr>
        </thead>
        </tbody>
      <?php 
            //listar dimensiones
            $dim = dimensiones();
            while($d = mysqli_fetch_array($dim)){
                $t = $d["id_dimension"].' - '.$d["dimension"];
                ?><tr><td colspan="4"><?php echo $t;?></td></tr><?php
                
                //listar ejes de la dimension actual
                $ejes = ejes_dim($d["id_dimension"]);
                while($e = mysqli_fetch_array($ejes)){
                    $t = $e["id_eje"].' - '.$e["eje"];
                    ?><tr><td></td><td colspan="3"><?php echo $t;?></td></tr><?php

                    //listar factores del eje actual
                    $factores = factores_eje($e["id_eje"]);
                    while($f = mysqli_fetch_array($factores)){
                        $t = $f["id_factor"].' - '.$f["factor"];
                        $id_factor = $f["id_factor"];
                        ?><tr><td></td><td></td><td><?php echo $t;?></td>
                        <td><?php 

                            //nro de iniciativas del factor
                            $n = cant_inic_factor($id_factor, $_SESSION["id_ciudad"]);
                            if($n == 0){
                              echo '<a href="abm_inic_lista.php?id='.$id_factor.'" 
                                style="color:red;">Iniciativas ('.$n.')</a>';                             
                            }else{
                              echo '<a href="abm_inic_lista.php?id='.$id_factor.'" 
                                style="color:green;">Iniciativas ('.$n.')</a>'; 
                            }
                            ?>   
                        </td></tr><?php
                    }
                }
            }
      ?>
    </tbody>  
    </table>
    </div>
  </body>
</html>