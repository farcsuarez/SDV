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
        include '../top.php';
        include '../cn_con.php';
        include 'navig.php';

        $id_factor = $_SESSION["id_factor"];
        $factor = factor($id_factor)["factor"];
        $id_item = $_POST["id_item"];
        $id_categoria = trim(explode("-", $_POST["id_categoria"])[0]);
        $nro_orden = $_POST["nro_orden"];
        $texto = $_POST["texto"];
        $descripcion = $_POST["descripcion"];
        $id_unidad = explode("-", $_POST["id_unidad"])[0];
        $tipo_resp = $_POST["tipo_resp"];

        //respuestas y valores normalizados
        $lista_1 = $_POST["lista_1"]; 
        $norma_1 = $_POST["norma_1"]; 
        $lista_2 = $_POST["lista_2"]; 
        $norma_2 = $_POST["norma_2"]; 
        $lista_3 = $_POST["lista_3"]; 
        $norma_3 = $_POST["norma_3"]; 
        $lista_4 = $_POST["lista_4"]; 
        $norma_4 = $_POST["norma_4"]; 

        $tipo_num = $_POST["tipo_num"];
        if($_POST["rango_inf"] == ""){
            $rango_inf = (float)0;
        }
        else{
            $rango_inf = (float)$_POST["rango_inf"];
        }
        if($_POST["rango_sup"] == ""){
            $rango_sup = (float)0;
        }
        else{
            $rango_sup = (float)$_POST["rango_sup"];
        }

            //eliminar dependencia respuestas de lista
            del_listas($id_item);

            //insertar respuestas de lista modificadas
            if($lista_1 != ""){
                ins_lista($id_item, $lista_1, $norma_1);
            }
            if($lista_2 != ""){
                ins_lista($id_item, $lista_2, $norma_2);
            }
            if($lista_3 != ""){
                ins_lista($id_item, $lista_3, $norma_3);
            }
            if($lista_4 != ""){
                ins_lista($id_item, $lista_4, $norma_4);
            }

            //eliminar dependencia capas 
                del_capas($id_item);

            //insertar capas modificadas
            $capas = capas(); //traer todas las capas, y ver cuales están en POST 
            while($capa = mysqli_fetch_array($capas)){
                $id_capa = $capa["id_capa"];
                if(isset($_POST["capa_".$id_capa])){
                    ins_capas($id_item, $_POST["capa_".$id_capa]);
                }
            }
            

        //modificar Item ----------------------------
        $sql = "update items
                set id_categoria='$id_categoria', nro_orden='$nro_orden', texto='$texto', 
                descripcion='$descripcion', tipo_resp='$tipo_resp', rango_inf='$rango_inf',
                rango_sup='$rango_sup', id_unidad='$id_unidad', tipo_num='$tipo_num'
                where id_item='$id_item'";

        if (mysqli_query($conn, $sql)) {
            ?> 
            <br><div class="container">
            <div class="alert alert-success">
                <?php echo 'Modificacion exitosa!';?></div>
            <a href="abm_items.php" class="btn btn-info" role="button">Volver</a>
            </div>   
            <?php  
        } 
        else {
            ?>
            <br><div class="container">
            <div class="alert alert-warning">
            <strong><?php echo "Error: ".mysqli_error($conn);?></strong> 
            </div>
            <a href="abm_items.php" class="btn btn-info" role="button">Volver</a>
            </div><?php
        }?>

    </body>
</html>
