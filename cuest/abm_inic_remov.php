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

    //CERROJO: verificar si hay permisos para remover iniciativa
    if(!hay_permiso($_SESSION["id_rol"], "in_iniciativas", "B")){

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
        
        $id_factor = $_SESSION["id_factor"]; //salir por metodo get

        if($_POST["confirma"] == 'SI'){
            $id = $_POST["id"];

            //eliminar capas asociadas
            $sql_capas = "delete from in_capas_inic
                           where id_iniciativa = '$id'";
            mysqli_query($conn, $sql_capas);

            //eliminar iniciativa
            $sql = "delete from in_iniciativas
                    where id = '$id'";
            if(mysqli_query($conn, $sql)){
                ?><br>
                <div class="container">
                    <div class="alert alert-success"><?php echo 'Eliminacion exitosa de Iniciativa'?></div>
                    <a href="abm_inic_lista.php?id=<?php echo $id_factor;?>" class="btn btn-info" role="button"> volver</a>
                </div><?php
            }else{
                ?>
                <br><div class="container">
                    <div class="alert alert-warning"><?php echo "Error: ".mysqli_error($conn);?> 
                    <a href="abm_inic_lista.php?id=<?php echo $id_factor;?>" class="btn btn-info" role="button"> volver</a>
                </div><?php
            }

        }else{
            ?>
            <div class="container">
                <div class="alert alert-success"><?php echo 'No hubo cambios';?></div>
                <a href="abm_inic_lista.php?id=<?php echo $id_factor;?>" class="btn btn-info" role="button">Listado</a>
            </div><?php
        }
        exit();
    }

    $id = $_GET["id"];
    $arr_inic = iniciativa($id);
    $txt = $arr_inic["titulo"];
    ?>

    <div class="container">
    <h2>Eliminar iniciativa: Confirma?</h2>
    <span><?php echo factor_full($_SESSION["id_factor"]); ?></span><br>

    <?php echo 'iniciativa: '.$txt;?>
        <br><br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            Id<br>
            <input type="text" name="id" value="<?php echo $id; ?>" size="5" readonly><br><br>

            Confirma<br>
            <select name="confirma">
                <option>NO</option>
                <option>SI</option>
            </select><br><br>

            <button type="submit">Enviar</button>
        </form>
    </div>
    </body>
</html>