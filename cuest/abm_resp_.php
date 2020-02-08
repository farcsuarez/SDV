<?php session_start(); ?>
<!DOCTYPE html>
<!-- traer preguntas del factor para responder -->

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
        include '../seg_fx.php';
        include 'navig.php';    

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //traer items de un factor
            $items = items($_SESSION["id_factor"]); 
            
            $id_ciudad = $_SESSION["id_ciudad"];
            $id_usuario = traer_usuario($_SESSION["user_log"])["id_usuario"];

            //buscar POST respondidos entre los items dados
            while($i = mysqli_fetch_array($items)){
                $id_item = $i["id_item"];
                
                if(($_POST[$id_item] != "")){ 

                    //tomar antigua respuesta del item y compararlo con la nueva
                    $resp_old = resp_old($id_item, $id_ciudad);
                    if($resp_old != $_POST[$id_item]){
                        //registrar cambio de respuesta
                        log_respuestas($id_item, $_POST[$id_item]);
                    }
                    
                    //eliminar, si existen respuesta previa al item y ciudad
                    $sql_del = "delete from respuestas 
                                where id_ciudad = '$id_ciudad' and id_item = '$id_item'";
                    mysqli_query($conn, $sql_del);
                    
                    //grabar última respuesta solamente
                    $sql = "insert into respuestas
                            (id_ciudad, id_usuario, id_item, respuesta) values
                            ('$id_ciudad', '$id_usuario', '$id_item', '$_POST[$id_item]')";
                    mysqli_query($conn, $sql);
                }
            }
            ?>
                <div class="container">
                    <div class="alert alert-success">Respuestas grabadas!
                        <a href="abm_resp.php" class="btn btn-info" role="button">volver</a>
                    </div>
                </div><?php

            exit(); //no recarga form
        }

        $_SESSION["id_factor"] = $_GET["id"];
        //traer items de un factor
        $items = items($_SESSION["id_factor"]); 
        ?>  

    <div class="container"><br>
        <h2>Form Registro de Respuestas</h2><br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <?php
            
            while($i = mysqli_fetch_array($items)){
                $id_item = $i["id_item"];
                $descripcion = $i["descripcion"];
                $texto = $i["texto"];
                $tipo_resp = $i["tipo_resp"];
                $unidad = unidad($i["id_unidad"])["unidad"];
                $txt = $id_item.' - '.$texto;

                //mostrar item a responder
                echo'<input type="text" id="'.$id_item.'" name="'.$id_item.'" value="'.$txt.'" size="110" readonly>';
                
                //traer respuesta previa, si existe y mostrar -se puede cambiar
                $r_pre = resp_item($id_item, $_SESSION["id_ciudad"])["respuesta"];

                if($tipo_resp == 'rango de valores'){
                    //textbox simple
                    echo'<br>Ingrese respuesta numerica <input type="text" style="text-align:right" 
                    id="'.$id_item.'" name="'.$id_item.'" value="'.$r_pre.'" size="8">';
                } 
                else{
                    echo '<br>seleccione respuesta de lista ';
                    echo'<select name="'.$id_item.'">';
                    echo'<option value="'.$r_pre.'">'.$r_pre.'</option>';
                    
                    $resp = resp_lista($id_item);
                    while($r = mysqli_fetch_array($resp)){
                        $re = substr($r["respuesta"], 0, 60); //limite ancho del select!
                        echo'<option value="'.$r["respuesta"].'">'.$re.'</option>';
                    }
                    echo'</select>';
                } echo'<br><br>'; 
            } //próxima pregunta
            ?>

            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
    </body>
</html>