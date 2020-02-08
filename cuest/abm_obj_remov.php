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
    include 'navig.php';

    //CERROJO: verificar si hay permisos para remover objetivos
    if(!hay_permiso($_SESSION["id_rol"], "in_objetivos", "B")){

        $id_iniciativa = objetivo($_GET["id"])["id_iniciativa"]; 
        //  mensaje
        ?>
            <br><div class="container">
            <div class="alert alert-warning">No tiene permisos para esta accion!</div>
            <a href="abm_obj.php?id=<?php echo $id_iniciativa;?>" class="btn btn-info" role="button"> volver</a>
        <?php 
        exit();
      }
      // fin CERROJO -----------------------------------------------------

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //lo pasamos x metodo get para volver al listado
        $id_iniciativa = objetivo($_POST["id_objetivo"])["id_iniciativa"]; 

        if($_POST["confirma"] == 'SI'){

            if(del_objetivo($_POST["id_objetivo"])){?>
            <br>
                <div class="container">
                    <div class="alert alert-success"><?php echo 'Eliminacion exitosa de Objetivo'?></div>
                    <a href="abm_obj.php?id=<?php echo $id_iniciativa;?>" class="btn btn-info" role="button"> volver</a>
                </div><?php 
            }
            else{?>
                <div class="container">
                    <div class="alert alert-danger">No puede eliminar un Objetivo que ya ha sido cumplimentado.</div>
                    <a href="abm_obj.php?id=<?php echo $id_iniciativa;?>" class="btn btn-info" role="button"> volver</a>
                </div><?php
            }
        }else{?>
            <div class="container">
                <div class="alert alert-success"><?php echo 'No hubo cambios';?></div>
                <a href="abm_obj.php?id=<?php echo $id_iniciativa;?>" class="btn btn-info" role="button"> volver</a>
            </div><?php
        }
        exit();
    }

    $id_objetivo = $_GET["id"];
    $txt = 'Objetivo nro '.$_GET["id"];
    
    ?>

    <div class="container">
    <h2>Eliminar Objetivo: Confirma?</h2>
    <?php echo $txt;?>
        <br><br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            Id Objetivo<br>
            <input type="text" name="id_objetivo" value="<?php echo $id_objetivo; ?>" size="5" readonly><br><br>
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