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
    include '../cn_con.php';
    include '../fx.php';
    include '../seg_fx.php';
    include 'navig.php';

    //CERROJO: verificar si hay permisos alta iniciativas
    if(!hay_permiso($_SESSION["id_rol"], "in_iniciativas", "A")){

      //  mensaje
      ?>
          <br><div class="container">
          <div class="alert alert-warning">No tiene permisos para esta accion!</div>
          <a href="abm_inic_lista.php?id=<?php echo $_SESSION["id_factor"];?>" class="btn btn-info" role="button">Volver</a>
      <?php 
      exit();
    }
    // fin CERROJO -----------------------------------------------------

    if(!isset($_SESSION["id_ciudad"])){?>
        <div class="container"><br>
        <div class="alert alert-warning">Se debe establecer una CIUDAD.</div>
        <?php exit(); //salir y establecer ciudad
    }
    
    //hay ciudad
    $id_ciudad = $_SESSION["id_ciudad"];
    $ciudad = ciudad($id_ciudad)["ciudad"];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_ciudad = $_SESSION["id_ciudad"];
        $id_factor = $_SESSION["id_factor"];
        $fecha_iniciativa = $_POST["fecha_iniciativa"];
        $titulo = $_POST["titulo"];
        $descripcion = $_POST["descripcion"];
        //$id_estado = trim(explode("-", $_POST["id_estado"])[0]);
        $id_usuario = $_SESSION["id_usuario"];

        $sql = "insert into in_iniciativas
                (id_ciudad, id_factor, fecha_iniciativa, titulo, descripcion, id_usuario) values 
                ('$id_ciudad', '$id_factor', '$fecha_iniciativa', '$titulo', '$descripcion', '$id_usuario')";

        //grabar iniciativa
        if(mysqli_query($conn, $sql)){

            //tomar id_iniciativa recien creado
            $id_iniciativa = mysqli_insert_id($conn);

            //tomar capas existentes
            $capas = capas();
            //buscar POST con id_capa 
            while($c = mysqli_fetch_array($capas)){
                $id_capa = $c["id_capa"];
                if(isset($_POST["capa_".$id_capa])){
                  ins_capas_inic($id_iniciativa, $id_capa);
                }
            }
            ?><br>
            <div class="container">
                <div class="alert alert-success"><?php echo 'Alta exitosa de Iniciativa : '.$titulo;?></div>
                <a href="abm_inic_lista.php?id=<?php echo $id_factor;?>" class="btn btn-info" role="button">Volver</a>
            </div><?php
        }
        else{
          ?>
            <br><div class="container">
            <div class="alert alert-warning">
            <?php echo "Error: ".mysqli_error($conn);?></div>
            <a href="abm_inic_lista.php?id=<?php echo $id_factor;?>" class="btn btn-info" role="button">Volver</a></div><?php
        }
        
        exit(); //no recarga form
    }

    $estados = estados();
    ?>

    <div class="container"><br>
      <h2>Form Registro Alta Iniciativa</h2>
      <span><?php echo factor_full($_SESSION["id_factor"]); ?>
              <a href="abm_inic_lista.php?id=<?php echo $_SESSION["id_factor"];?>" class="btn btn-info" role="button"> volver</a></span>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        
          Fecha iniciativa:<br> <!-- maravilloso control de html -->
            <input type="date" name="fecha_iniciativa" id="fecha_iniciativa"><br><br>
          
          Capas:<br> 
                <?php include 'capas.php'; ?><br>

          Título:<br>
            <input type="text" name="titulo" size="100" required><br><br>   
            
          Descripcion:<br>
            <input type="text" name="descripcion" size="100"><br><br>
          
          <!--
          Estado:<br>
            <select name="id_estado">
                <?php 
                   /*  while($e = mysqli_fetch_array($estados)){
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