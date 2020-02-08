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

    //CERROJO: verificar si hay permisos para modif objetivos
    if(!hay_permiso($_SESSION["id_rol"], "in_objetivos", "M")){
        
      //tomar id iniciativa para volver
        $id_objetivo = $_GET["id"];
        $id_iniciativa = objetivo($id_objetivo)["id_iniciativa"];
        //  mensaje
        ?>
            <br><div class="container">
            <div class="alert alert-warning">No tiene permisos para esta accion!</div>
            <a href="abm_obj.php?id=<?php echo $id_iniciativa;?>" class="btn btn-info" role="button"> volver</a></div>
            
        <?php 
        exit();
     }
     // fin CERROJO -----------------------------------------------------
 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_objetivo = $_POST["id_objetivo"];
        $id_iniciativa = explode("-", $_POST["id_iniciativa"])[0];
        $objetivo = $_POST["objetivo"];
        $objetivo_porc = $_POST["objetivo_porc"];
        $fecha_obj = $_POST["fecha_obj"];
        $responsable = $_POST["responsable"];

        $sql = "update in_objetivos
                 set id_iniciativa = '$id_iniciativa', objetivo = '$objetivo', objetivo_porc = '$objetivo_porc', 
                 fecha_obj = '$fecha_obj', responsable = '$responsable'
                where id_objetivo = '$id_objetivo'";

        //grabar objetivo
        if(mysqli_query($conn, $sql)){
            ?><br>
            <div class="container">
                <div class="alert alert-success"><?php echo 'Modificacion exitosa de Objetivo';?></div>
                <a href="abm_obj.php?id=<?php echo $id_iniciativa;?>" class="btn btn-info" role="button">Listado</a>
            </div><?php
        }
        else{
          ?>
            <br><div class="container">
            <div class="alert alert-warning">
            <?php echo "Error: ".mysqli_error($conn);?></div>
            <a href="abm_obj.php?id=<?php echo $id_iniciativa;?>" class="btn btn-info" role="button">Listado</a></div><?php
        }
        
        exit(); //no recarga form
    }

    $id_objetivo = $_GET["id"];
    $iniciativas = iniciativas();
    $objetivo = objetivo($id_objetivo);
    $obj = $objetivo["objetivo"];
    $objetivo_porc = $objetivo["objetivo_porc"];
    $fecha_obj = $objetivo["fecha_obj"];
    $responsable = $objetivo["responsable"];
    $grado = $objetivo["grado_cumplimiento"];
    $id_inic = iniciativa($objetivo["id_iniciativa"])["id"];
    $titulo = iniciativa($objetivo["id_iniciativa"])["titulo"];
    $txt = $id_inic.' - '.$titulo;
    $max_porc = 100 - suma_aporte_obj($id_inic, $id_objetivo);
    ?>

    <div class="container"><br>

      <h2>Form Modifica Objetivos</h2>
      <span><?php echo factor_full($_SESSION["id_factor"]); ?>
          <a href="abm_obj.php?id=<?php echo $id_inic;?>" class="btn btn-info" role="button"> volver</a></span>

      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        
          id objetivo:<br>
            <input type="text" name="id_objetivo" size="5" value="<?php echo $id_objetivo; ?>" readonly><br><br> 

          Iniciativa:<br>
          <input type="text" name="id_iniciativa" size="120" value="<?php echo $txt; ?>" readonly><br><br> 

          Objetivo:<br>
            <input type="text" name="objetivo" size="120" value="<?php echo $obj; ?>" required><br><br>  

            % de Contribucion a la Iniciativa (entre 0 y <?php echo $max_porc; ?>):<br>
            <input type="number" name="objetivo_porc" min="0" max="<?php echo $max_porc;?>" 
                        value="<?php echo $objetivo_porc; ?>" required><br><br>

          Fecha Objetivo:<br> <!-- maravilloso control de html -->
            <input type="date" name="fecha_obj" value="<?php echo $fecha_obj; ?>" required><br><br>
          
          Responsable:<br>
            <input type="text" name="responsable" size="40"  value="<?php echo $responsable; ?>" required><br><br>   
            
          Grado cumplimiento (entre 0 y 100):<br>
            <input type="number" style="background-color:lightgrey;" name="grado_cumplimiento" min="0" max="100"
                     value="<?php echo $grado; ?>" readonly><br><br>

            <button type="submit">Enviar</button>
      </form>
    </div>
    </body>
</html>