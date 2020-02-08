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
        $nro_orden = $_POST["nro_orden"];
        $_SESSION["nro_orden"] = $nro_orden + 1; //sugerencia para próximo item a cargar
        $texto = $_POST["texto"];
        $id_categoria = explode("-", $_POST["id_categoria"])[0];
        $_SESSION["categoria"] = $_POST["id_categoria"]; //sugerencia para próximo item a cargar
        $descripcion = $_POST["descripcion"];
        $tipo_resp = $_POST["tipo_resp"];

        if($tipo_resp == 'lista de items'){
            $tipo_num = 'none';
            $rango_inf = (float)0;
            $rango_sup = (float)0;
            $id_unidad = 'none';
            $lista_1 = $_POST["lista_1"];
            $lista_2 = $_POST["lista_2"];
            $lista_3 = $_POST["lista_3"];
            $lista_4 = $_POST["lista_4"];
            $norma_1 = $_POST["norma_1"];
            $norma_2 = $_POST["norma_2"];
            $norma_3 = $_POST["norma_3"];
            $norma_4 = $_POST["norma_4"];
        }
        else{
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
            $id_unidad = explode("-", $_POST["id_unidad"])[0];
        }

        //almacenar nuevo Item ----------------------------
        $sql = "insert into items
                (id_factor, id_categoria, nro_orden, texto, descripcion, tipo_resp,
                    rango_inf, rango_sup, id_unidad, tipo_num) values
                ('$id_factor', '$id_categoria', '$nro_orden', '$texto', '$descripcion', '$tipo_resp', 
                '$rango_inf', '$rango_sup', '$id_unidad', '$tipo_num')";

        if (mysqli_query($conn, $sql)){
            
            //tomar id_item recien creado
            $id_item = mysqli_insert_id($conn);

            //buscar POST con capas  
            $capas = capas();
            while($c = mysqli_fetch_array($capas)){            
                $t = "capa_".$c["id_capa"];
                //insertar relacion item - capa
                if(isset($_POST[$t])){
                    ins_capas($id_item, $_POST[$t]);
                }
            }
               

                //hay respuestas de lista?
                if($tipo_resp == 'lista de items'){
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
                }

            ?><br>
            <div class="container">
                <div class="alert alert-success"><?php echo 'Alta exitosa del Item :'.$texto;?></div>
                <a href="abm_items.php" class="btn btn-info" role="button">Listado ABM</a>
                <a href="abm_items_new.php" class="btn btn-info" role="button">Nueva Alta</a>
            </div><?php
        } 
        else {
            ?>
            <br><div class="container">
            <div class="alert alert-warning">
            <?php echo "Error: ".mysqli_error($conn);?></div>
            <a href="abm_items.php" class="btn btn-info" role="button">Volver</a></div><?php
        }?>

    </body>
</html>