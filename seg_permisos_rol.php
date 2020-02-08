<?php session_start(); ?>
<!DOCTYPE html>

<!-- Asignar/Actualizar PERMISOS a un ROL -->

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

    //CERROJO: verificar si hay permisos para modificar rol
    if(!hay_permiso($_SESSION["id_rol"], "seg_roles_accion", "M")){
        
        //  mensaje
        ?>
            <br><div class="container">
            <div class="alert alert-warning">No tiene permisos para esta accion!
                <a href="seg_abm_rol.php" class="btn btn-info" role="button"> volver</a></div>
            </div>
        <?php 
        exit();
     }
     // fin CERROJO -----------------------------------------------------


    echo '<div class="container">';
        //seleccionar ROL previamente (session)
        $_SESSION["id_rol_"] = $_GET["id"];
        $rol = rol($_SESSION["id_rol_"])["rol"];
      
        echo '<br><h3>Asignacion Permisos a ROL: '.$rol.'</h3>';
        echo '<a href="seg_abm_rol.php" class="btn btn-info" role="button">volver a Roles</a><br><br>';
        echo '<p style="background-color:lime">Nota: Para asignar permisos A, B y/o M, debe ser asignado el permiso C</p>';
        echo '<form method="post" action="seg_permisos_rol_.php">';
        
            $objetos = traer_tablas();
            //recorrer objetos y listarlos
            echo '<table class="table table-striped w-100">';
            echo '<thead><tr><th>permisos</th><th>objetos</th><th>nota</th></tr></thead>';
            while($t = mysqli_fetch_array($objetos)){
                $obj = $t[0]; //objeto (tabla)
                $comentario = traer_table_comment($obj);
                echo '<tr>';

                if(hay_permiso($_SESSION["id_rol_"], $obj, "A")){
                    echo '<td><input type="checkbox" name="A'.$obj.'" checked>Alta&nbsp&nbsp';
                }else{
                    echo '<td><input type="checkbox" name="A'.$obj.'">Alta&nbsp&nbsp';
                }

                if(hay_permiso($_SESSION["id_rol_"], $obj, "B")){
                    echo '<input type="checkbox" name="B'.$obj.'" checked>Baja&nbsp&nbsp';
                }else{
                    echo '<input type="checkbox" name="B'.$obj.'">Baja&nbsp&nbsp';
                }

                if(hay_permiso($_SESSION["id_rol_"], $obj, "M")){
                    echo '<input type="checkbox" name="M'.$obj.'" checked>Modi&nbsp&nbsp';
                }
                else{
                    echo '<input type="checkbox" name="M'.$obj.'">Modi&nbsp&nbsp';
                }    

                if(hay_permiso($_SESSION["id_rol_"], $obj, "C")){
                    echo '<input type="checkbox" name="C'.$obj.'" checked>Cons</td>';
                }else{
                    echo '<input type="checkbox" name="C'.$obj.'">Cons</td>';
                }

                //columna de objetos (tablas)
                echo '<td><strong>'.$obj.'</strong></td>';
                echo '<td>'.$comentario.'</td></tr>';
            }
            echo '</table>';

            echo '<button type="submit">enviar</button>';
            echo '</form>';
            echo '</div>';
    ?>
</body>
</html>

<script>
var checkBox = document.getElementById($obj);
</script>