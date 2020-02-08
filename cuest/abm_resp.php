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

    //CERROJO: verificar si hay permisos para responder items
    if(!hay_permiso($_SESSION["id_rol"], "respuestas", "C")){

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
        <?php exit; //salir y establecer factor
      }
    ?>

    <div class="container"><br>

    <h2>Responder Cuestionario: seleccione FACTOR</h2>
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
                ?><tr><td colspan="5"><?php echo $t;?></td></tr><?php
                
                //listar ejes de la dimension actual
                $ejes = ejes_dim($d["id_dimension"]);
                while($e = mysqli_fetch_array($ejes)){
                    $t = $e["id_eje"].' - '.$e["eje"];
                    ?><tr><td></td><td colspan="2"><?php echo $t;?></td><td></td><td></td></tr><?php

                    //listar factores del eje actual
                    $factores = factores_eje($e["id_eje"]);
                    while($f = mysqli_fetch_array($factores)){
                        $t = $f["id_factor"].' - '.$f["factor"];
                        $id_factor = $f["id_factor"];
                        ?><tr><td></td><td></td><td><?php echo $t;?></td>
                        <td><?php 
                              //items respondidos / total items
                              $r = cant_resp($_SESSION["id_ciudad"], $id_factor);
                              $t = cant_preg($id_factor);
                              $txt = $r.' / '.$t;

                              //todas las preguntas respondidas, verde
                              if($r == $t && $t > 0){
                                  echo '<span style="color:green">'.$txt.'</span>';
                              }

                              //hay preguntas sin responder, azul
                              if($r < $t && $t > 0 && $r > 0){
                                echo '<span style="color:blue">'.$txt.'</span>';
                              }

                              //ninguna pregunta respondida, rojo
                              if($r == 0 && $t > 0){
                                echo '<span style="color:red">'.$txt.'</span>';
                              }

                              //no hay preguntas definidas en este factor
                              if($t == 0){
                                echo '<span style="color:black">'.$txt.'</span>';
                              }
                            ?>   
                        </td>
                        <td><?php
                                //todo respondido, verde
                                if($r == $t && $t > 0){ 
                                    echo '<a style="color:green" href="abm_resp_.php?id='.$id_factor.'">
                                          actualizar respuestas</a>';
                                }

                                //falta responder items, azul
                                if($r < $t && $t > 0 && $r > 0){ 
                                    echo '<a style="color:blue" href="abm_resp_.php?id='.$id_factor.'">
                                          continuar cuestionario</a>';
                                }

                                //nada respondido, rojo
                                if($r == 0 && $t > 0){
                                  echo '<a style="color:red" href="abm_resp_.php?id='.$id_factor.'">responder cuestionario</a>';
                                }

                              ?></td></tr><?php
                    }
                }
            }
      ?>
    </tbody>  
    </table>
    </div>
  </body>
</html>