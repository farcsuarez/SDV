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
        include 'navig.php';

        $id_factor = $_GET["id_factor"];
        $_SESSION["id_factor"] = $id_factor;
        $id_nivel = $_SESSION["id_nivel"];
        $items = items($id_factor);//tomar preguntas del factor

        ?>
        <div class="container"><br>
        <div class="alert alert-success">
            Factor: <?php echo factor($id_factor)["factor"];?><br>
            Nivel establecido: <?php echo nivel($_SESSION["id_nivel"])["nivel"];?>
            <a href="abm_pon.php" class="btn btn-info" role="button">Volver</a>
        </div>
        <h2>Form Ponderacion ITEMS</h2>
        <form action="abm_pon_it_act.php" method="post">
        <?php
            $contador = 0; //para colorear filas pares
            while($p = mysqli_fetch_array($items)){
                $contador++;
                $id_item = $p["id_item"];
                $texto = $p["texto"];
                $t = $id_item.' - '.$texto;
                $p = ponderacion("ITE", $id_item, $id_nivel); //traer ponderacion 
                if($contador % 2 == 0){
                    //colorear filas
                    echo'<input type="text" style="background-color:gainsboro;" name="'.$id_item.'" value="'.$t.'" size="130" readonly>';
                    echo'<input type="text" style="background-color:gainsboro; text-align:center" name="v'.$id_item.'" value="'.$p.'" size="5"><br>';
                }
                else{
                    echo'<input type="text" name="'.$id_item.'" value="'.$t.'" size="130" readonly>';
                    echo'<input type="text" style="text-align:center" name="v'.$id_item.'" value="'.$p.'" size="5"><br>';
                }
            }?>
            <input type="submit" value="enviar">
        </form>    
        </div>
    </body>
</html>