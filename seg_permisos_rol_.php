<?php session_start(); ?>
<!DOCTYPE html>

<!-- eliminar permisos, escanear checkboxs y establecer los nuevos -->

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
        include 'top.php';
        include 'navig.php';
        include 'seg_fx.php';
        del_permisos($_SESSION["id_rol_"]);

        $objetos = traer_tablas();
        while($t = mysqli_fetch_array($objetos)){
            $permisos = "";
            //escanear checkboxs
            
            if(isset($_POST["A".$t[0]])){
                $permisos .= "A";
            }
            if(isset($_POST["B".$t[0]])){
                $permisos .= "B";
            }
            if(isset($_POST["M".$t[0]])){
                $permisos .= "M";
            }
            if(isset($_POST["C".$t[0]])){
                $permisos .= "C";
            }
            asignar_permiso($_SESSION["id_rol_"], $t[0], $permisos);    
        }
    ?>
        <br><div class="container">
            <div class="alert alert-success">Se actualizaron los Permisos del Rol
                <a href="seg_abm_rol.php" class="btn btn-info" role="button">ROLES</a>
            </div>
        </div>    
    </body>
</html>