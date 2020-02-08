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

         //CERROJO: verificar si hay permisos para objetivos
         if(!hay_permiso($_SESSION["id_rol"], "in_objetivos", "A")){
            $id_iniciativa = $_GET["id"];
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
        $id_iniciativa = explode("-", $_POST["id_iniciativa"])[0];
        $objetivo_porc = $_POST["objetivo_porc"];
        $objetivo = $_POST["objetivo"];
        $fecha_obj = $_POST["fecha_obj"];
        $responsable = $_POST["responsable"];

        $sql = "insert into in_objetivos
                (id_iniciativa, objetivo, objetivo_porc, fecha_obj, responsable) values 
                ('$id_iniciativa', '$objetivo', '$objetivo_porc', '$fecha_obj', '$responsable')";

        //grabar objetivo
        if(mysqli_query($conn, $sql)){
            ?><br>
            <div class="container">
                <div class="alert alert-success"><?php echo 'Alta exitosa de Objetivo';?></div>
                <a href="abm_obj.php?id=<?php echo $id_iniciativa;?>" class="btn btn-info" role="button">volver</a>
            </div><?php
        }
        else{
          ?>
            <br><div class="container">
            <div class="alert alert-warning">
            <?php echo "Error: ".mysqli_error($conn);?></div>
            <a href="abm_obj.php?id=<?php echo $id_iniciativa;?>" class="btn btn-info" role="button">volver</a></div><?php
        }
        
        exit(); //no recarga form
    }
    $id_iniciativa = $_GET["id"];

    //calcular total de % de cumplimiento de objetivos acumulados, si los hubiere
    $tot_acum = suma_aporte_objetivo($id_iniciativa);
    $max_res = 100 - $tot_acum;
    if ($tot_acum == 100){
        ?>
              <br><div class="container">
              <div class="alert alert-warning">La suma de contribuciones ya está al 100%, 
                                                  no se pueden agregar mas Objetivos a esta Iniciativa!</div>
              <a href="abm_obj.php?id=<?php echo $id_iniciativa;?>" class="btn btn-info" role="button">volver</a></div><?php
        exit();
    }

    $titulo = iniciativa($id_iniciativa)["titulo"];
    $t = $id_iniciativa.' - '.$titulo;
    ?>

    <div class="container"><br>

      <h2>Form Registro Alta Objetivos</h2>
      <span><?php echo factor_full($_SESSION["id_factor"]); ?>
          <a href="abm_obj.php?id=<?php echo $id_iniciativa;?>" class="btn btn-info" role="button"> volver</a></span>
          
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        
            Iniciativa:<br>
            <input type="text" style="background-color:lightgrey;" name="id_iniciativa" value="<?php echo $t;?>"  size="120" readonly><br><br>
          
            Objetivo:<br>
            <input type="text" name="objetivo" size="120" required><br><br>

          % de Contribucion a la Iniciativa (entre 0 y <?php echo $max_res;?>):<br>
            <input type="number" name="objetivo_porc" min="0" max="<?php echo $max_res;?>" size="50" required><br><br>

          Fecha Objetivo:<br> <!-- maravilloso control de html -->
            <input type="date" name="fecha_obj" required><br><br>
          
          Responsable:<br>
            <input type="text" name="responsable" size="50" required><br><br>   
            
          Grado cumplimiento (entre 0 y 100):<br>
            <input type="number" style="background-color:lightgrey;" name="grado_cumplimiento" min="0" max="100" readonly><br><br>

            <button type="submit">Enviar</button>
      </form>
    </div>
    </body>
</html>