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
        include '../cn_con.php';
        include '../top.php';
        include 'navig.php';
        $id_nivel = $_SESSION["id_nivel"];

        //buscar POST de dimensiones
        $dim = dimensiones();
        while($d = mysqli_fetch_array($dim)){
            $id_elemento = $d["id_dimension"] ;
            $v = 'vG'.$d["id_dimension"];
            $pond = $_POST[$v];
            almacenar_pond("DIM", $id_elemento, $id_nivel, $pond);
        }

        //buscar POST de ejes
        $eje = ejes();
        while($d = mysqli_fetch_array($eje)){
            $id_elemento = $d["id_eje"] ;
            $v = 'vE'.$d["id_eje"];
            $pond = $_POST[$v];
            almacenar_pond("EJE", $id_elemento, $id_nivel, $pond);
        }

        //buscar POST de factores
        $fac = factores();
        while($d = mysqli_fetch_array($fac)){
            $id_elemento = $d["id_factor"] ;
            $v = 'vF'.$d["id_factor"];
            $pond = $_POST[$v];
            almacenar_pond("FAC", $id_elemento, $id_nivel, $pond);
        }?>

        <br><div class="container">
        <div class="alert alert-success">
            Ponderaciones almacenadas!
            <a href="abm_pon.php" class="btn btn-info" role="button">volver</a>
        </div></div>

    </body>
</html>