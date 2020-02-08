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
        include '../cn_con.php';
        include 'navig.php';

        $id_factor = $_SESSION["id_factor"];
        $id_nivel = $_SESSION["id_nivel"];

        $items = items($id_factor);//tomar preguntas del factor
        //tomar los valores del POST del form
        while($i = mysqli_fetch_array($items)){
            $x = 'v'.$i["id_item"];
            $pond = $_POST[$x];
            $id_elemento = $i["id_item"];
            almacenar_pond("ITE", $id_elemento, $id_nivel, $pond);
        }?>
        <br><div class="container">
        <div class="alert alert-success">
            Ponderaciones almacenadas!
            <a href="abm_pon.php" class="btn btn-info" role="button">volver</a>
        </div></div>

    </body>
</html>