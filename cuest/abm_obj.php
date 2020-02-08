<?php session_start(); ?>
<!DOCTYPE html>

<!-- Lista de OBJETIVOS de una INICIATIVA determinada  -->

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
    
        //CERROJO: verificar si hay permisos para objetivos
        if(!hay_permiso($_SESSION["id_rol"], "in_objetivos", "C")){
          $id_factor = $_SESSION["id_factor"];
          //  mensaje
          ?>
              <br><div class="container">
              <div class="alert alert-warning">No tiene permisos para esta accion!</div>
              <a href="abm_inic_lista.php?id=<?php echo $id_factor;?>" class="btn btn-info" role="button"> volver</a></span>
          <?php 
          exit();
        }
        // fin CERROJO -----------------------------------------------------

    $id_iniciativa = $_GET["id"]; 
    $titulo = iniciativa($id_iniciativa)["titulo"];
    $id_factor = $_SESSION["id_factor"];

    //acumulado de aportes a la iniciativa por parte de los objetivos asociados
    $tot_acum = suma_aporte_objetivo($id_iniciativa);
    ?>

    <div class="container">
    <br>
    <a href="abm_obj_new.php?id=<?php echo $id_iniciativa;?>" class="btn btn-info" role="button">Nuevo Objetivo</a>
      <h3>Lista de Objetivos</h3>
      <span><?php echo factor_full($_SESSION["id_factor"]); ?></span><br>
      <span style="color:tomato;"><?php echo 'Iniciativa: <strong>'.$titulo.'</strong> 
      :Total de Contrib acum: '.$tot_acum.'%'; ?>
          <a href="abm_inic_lista.php?id=<?php echo $id_factor;?>" class="btn btn-info" role="button"> volver</a></span>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>id</th>
            <th>fecha</th>
            <th>objetivo</th>
            <th>% contrib</th>
            <th>responsable</th>
            <th>cumplim %</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $obj = objetivos($id_iniciativa);
            while($o = mysqli_fetch_array($obj)){
              $fecha = date("d/m/Y", strtotime($o["fecha_obj"]));
                echo '<tr>
                <td>'.$o["id_objetivo"].'</td>
                <td>'.$fecha.'</td>
                <td>'.$o["objetivo"].'</td>
                <td>'.$o["objetivo_porc"].'</td>
                <td>'.$o["responsable"].'</td>
                <td>'.$o["grado_cumplimiento"].'</td>
                <td><a href="abm_obj_cumplir.php?id='.$o["id_objetivo"].'">cumplimiento</a></td>
                <td><a href="abm_obj_modif.php?id='.$o["id_objetivo"].'">modificar</a></td>
                <td><a href="abm_obj_remov.php?id='.$o["id_objetivo"].'">eliminar</a></td>
                </tr>';
            }
          ?>
        </tbody>
      </table>
    </div>
    </body>
</html>