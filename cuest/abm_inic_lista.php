<?php session_start(); ?>
<!DOCTYPE html>

<!-- lista de iniciativas de un factor determinado -->

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

      //CERROJO: verificar si hay permisos lista iniciativas
        if(!hay_permiso($_SESSION["id_rol"], "in_iniciativas", "C")){

            //  mensaje
            ?>
                <br><div class="container">
                <div class="alert alert-warning">No tiene permisos para esta accion!</div>
                <a href="abm_inic.php" class="btn btn-info" role="button">Volver</a>
            <?php 
            exit();
        }
        // fin CERROJO -----------------------------------------------------

        $_SESSION["id_factor"] = $_GET["id"]; 
        $id_factor = $_SESSION["id_factor"];
        $id_ciudad = $_SESSION["id_ciudad"];
        ?>

        <div class="container">
        <br>
        <a href="abm_inic_new.php" class="btn btn-info" role="button">Nueva Iniciativa</a>
            <h3>Lista de Iniciativas</h3>
            <span><?php echo factor_full($_SESSION["id_factor"]); ?>
                    <a href="abm_inic.php" class="btn btn-info" role="button"> volver</a></span>
            <table class="table table-striped">
            <thead>
                <tr>
                <th>id inic</th>
                <th>fecha</th>
                <th>titulo</th>
                </tr>
            </thead>
            <tbody>
                <?php

                //traer iniciativas del factor y ciudad
                $inic = inic_factor($id_factor, $id_ciudad);
                while($x = mysqli_fetch_array($inic)){
                    //cantidad de objetivos por iniciativa
                    $n = cant_objetivos($x["id"]);
                    if($n == 0){
                        $color = "red";
                    }else{
                        $color = "green";
                    }
                    $fecha = date("d/m/Y", strtotime($x["fecha_iniciativa"]));
                    echo '<tr>
                    <td>'.$x["id"].'</td>
                    <td>'.$fecha.'</td>
                    <td>'.$x["titulo"].'</td>
                    <td><a href="abm_obj.php?id='.$x["id"].'" style="color:'.$color.';">objetivos ('.$n.')</a></td>
                    <td><a href="abm_inic_modif.php?id='.$x["id"].'">modificar</a></td>
                    <td><a href="abm_inic_remov.php?id='.$x["id"].'">eliminar</a></td>
                    </tr>';
                }
                ?>
            </tbody>
            </table>
        </div>
    </body>
</html>