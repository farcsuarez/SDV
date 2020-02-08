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
    <body onload="getfocus()">
    
    <?php 
        include '../top.php';
        include '../fx.php';
        include '../seg_fx.php';
        include '../cn_con.php';
        include 'navig.php';

        //CERROJO: verificar si hay permisos
        if(!hay_permiso($_SESSION["id_rol"], "it_unidades", "M")){
            
            //  mensaje
            ?>
                <br><div class="container">
                <div class="alert alert-warning">No tiene permisos para esta accion!</div>
                <a href="abm_uni.php" class="btn btn-info" role="button"> volver</a>
            <?php 
            exit();
        }
        // fin CERROJO -----------------------------------------------------


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id_unidad = $_POST["id_unidad"];
            $tipo = $_POST["tipo"];
            $unidad = $_POST["unidad"];
            $sql = "update it_unidades set tipo = '$tipo', unidad = '$unidad'
                    where id_unidad = '$id_unidad'";

            if(mysqli_query($conn, $sql)){
                ?><br><div class="container">
                <div class="alert alert-success">
                <?php echo 'Modificacion exitosa de Unidad';?></div>
                <a href="abm_uni.php" class="btn btn-info" role="button">Volver</a></div><?php
            }
            else{
                ?><br><div class="container">
            <div class="alert alert-warning"><?php echo "Error: ".mysqli_error($conn);?></div>
            <a href="abm_uni.php" class="btn btn-info" role="button">Volver</a></div><?php
            }
            exit(); //no recarga form
        }

        $id_unidad = $_GET["id"];
        $obj_uni = unidad($id_unidad);
        $tipo = $obj_uni["tipo"];
        $unidad = $obj_uni["unidad"];
        ?>

        <div class="container">
        <h2>Form Modificar Unidad</h2>
        <a href="abm_uni.php" class="btn btn-info" role="button"> volver</a>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
                <label for="id_unidad">id unidad:</label>
                <input type="text" class="form-control" id="id_unidad" placeholder="" 
                    name="id_unidad" value="<?php echo $id_unidad; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="tipo">tipo:</label>
                <select class="form-control" id="tipo" name="tipo">
                <?php echo '<option>'.$tipo.'</option>'?>
                    <option>cantidad</option>
                    <option>longitud</option>
                    <option>tiempo</option>
                    <option>peso</option>
                    <option>velocidad</option>
                    <option>no aplica</option>
                </select>
            </div>
            <div class="form-group">
                <label for="unidad">Unidad:</label>
                <input type="text" class="form-control" id="unidad" placeholder="" name="unidad" 
                value = "<?php echo $unidad; ?>" required>
            </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        </div>

    </body>
</html>
<script>
  function getfocus(){
    document.getElementById("unidad").focus();
  }
</script>