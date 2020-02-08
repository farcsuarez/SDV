<?php session_start(); ?>
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
        include '../cn_con.php';
        include 'navig.php';

        //CERROJO: verificar si hay permisos para modificar iniciativas
        if(!hay_permiso($_SESSION["id_rol"], "in_iniciativas", "M")){
            $id_factor = $_SESSION["id_factor"];
            //  mensaje
            ?>
                <br><div class="container">
                <div class="alert alert-warning">No tiene permisos para esta accion!</div>
                <a href="abm_inic_lista.php?id=<?php echo $id_factor;?>" class="btn btn-info" role="button"> volver</a>
            <?php 
            exit();
        }
        // fin CERROJO -----------------------------------------------------

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id_iniciativa = $_POST["id"];
            $fecha_iniciativa = $_POST["fecha_iniciativa"];
            $titulo = $_POST["titulo"];
            $descripcion = $_POST["descripcion"];
            //$id_estado = trim(explode("-", $_POST["id_estado"])[0]);
            $id_usuario = $_SESSION["id_usuario"];
            $id_factor = $_SESSION["id_factor"];
    
            $sql = "update in_iniciativas
                    set fecha_iniciativa = '$fecha_iniciativa', titulo = '$titulo', 
                    descripcion = '$descripcion', id_usuario = '$id_usuario' 
                    where id = '$id_iniciativa'";
    
            //grabar iniciativa
            if(mysqli_query($conn, $sql)){
                
                //eliminar capas-iniciativas para modificar luego
                del_capas_inic($id_iniciativa);

                //tomar capas existentes
                $capas = capas();
                //buscar POST[capa_$idcapa]  
                while($c = mysqli_fetch_array($capas)){
                    $id_capa = $c["id_capa"];
                    if(isset($_POST["capa_".$id_capa])){
                      ins_capas_inic($id_iniciativa, $id_capa);
                    }
                }
                ?><br>
                <div class="container">
                    <div class="alert alert-success"><?php echo 'Modificacion exitosa de Iniciativa : '.$titulo;?></div>
                    <a href="abm_inic_lista.php?id=<?php echo $id_factor;?>" class="btn btn-info" role="button">Listado</a>
                </div><?php
            }
            else{
              ?>
                <br><div class="container">
                <div class="alert alert-warning">
                <?php echo "Error: ".mysqli_error($conn);?></div>
                <a href="abm_inic_lista.php?id=<?php echo $id_factor;?>" class="btn btn-info" role="button">Listado</a></div><?php
            }
            
            exit(); //no recarga form
        }

        //tomar la iniciativa a modificar
        $id = $_GET["id"];
        $arr_ini = iniciativa($id);
        $f_ini = $arr_ini["fecha_iniciativa"];
        $titulo = $arr_ini["titulo"];
        $desc = $arr_ini["descripcion"];
        //$id_estado = $arr_ini["id_estado"];
        //$estado = estado($id_estado)["estado"];
        //$txt = $id_estado.' - '.$estado;
        //$estados = estados();
        $capas = capas();
        $arr_cap = traer_capas_inic($id); //array listo con las capas de la iniciativa
        ?>
    
    <div class="container"><br>
    <h2>Form Modificar Iniciativa</h2>
    <span><?php echo factor_full($_SESSION["id_factor"]); ?>
              <a href="abm_inic_lista.php?id=<?php echo $_SESSION["id_factor"];?>" class="btn btn-info" role="button"> volver</a></span>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            Id:<br>
                <input type="text" name="id" size="5" value="<?php echo $id; ?>" readonly><br><br>

            Fecha iniciativa:<br> <!-- maravilloso control de html -->
                <input type="date" name="fecha_iniciativa" id="fecha_iniciativa"
                    value="<?php echo $f_ini; ?>"><br><br>
            
            Capas:<br> 
                    <?php 
                        //crear checkboxes de capas y marcar capas existentes en esta iniciativa
                        while($c = mysqli_fetch_array($capas)){
                            $id_capa = $c["id_capa"];
                            $capa = $c["capa"];
                            if(in_array($id_capa, $arr_cap)){
                                echo '<input type="checkbox" name="capa_'.$id_capa.'" value="'.$id_capa.'" checked> '.$capa.'<br>';
                            }else{
                                echo '<input type="checkbox" name="capa_'.$id_capa.'" value="'.$id_capa.'"> '.$capa.'<br>';
                            }
                        }
                    ?><br>

            Título:<br>
                <input type="text" name="titulo" size="100" value="<?php echo $titulo; ?>" required><br><br>   
                
            Descripcion:<br>
                <input type="text" name="descripcion" value="<?php echo $desc; ?>" size="100"><br><br>

            <!--
            Estado:<br>
                <select name="id_estado">
                    <?php 
                    /* echo '<option>'.$txt.'</option>';
                        while($e = mysqli_fetch_array($estados)){
                            $id = $e["id"];
                            $estado = $e["estado"];
                            $txt = $id.' - '.$estado;
                            echo '<option>'.$txt.'</option>';
                        } */
                    ?>
                </select><br><br>
            -->
             
            <button type="submit">Enviar</button>
        </form>
    </div>
    </body>
</html>