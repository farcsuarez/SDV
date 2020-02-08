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
      if(!hay_permiso($_SESSION["id_rol"], "it_unidades", "A")){
          
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

        $sql = "insert into it_unidades (id_unidad, tipo, unidad) 
                values ('$id_unidad', '$tipo', '$unidad')";

          if(mysqli_query($conn, $sql)){
              ?><br><div class="container">
              <div class="alert alert-success"><?php echo 'Alta exitosa de unidad';?></div>
              <a href="abm_uni.php" class="btn btn-info" role="button">Volver</a></div><?php
          }
          else{
              ?><br><div class="container">
            <div class="alert alert-warning"><?php echo "Error: ".mysqli_error($conn);?></div>
            <a href="abm_uni.php" class="btn btn-info" role="button">Volver</a>
            </div><?php
          }
          exit(); //no recarga form
      }
      ?>

      <div class="container">
        <h2>Form Registro Alta Unidades</h2>
        <a href="abm_uni.php" class="btn btn-info" role="button"> volver</a>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <div class="form-group">
            <label for="id_unidad">id Unidad (5 carac max):</label>
            <input type="text" class="form-control" id="id_unidad" placeholder="Ingrese id de max 5 caracteres" 
            name="id_unidad" required>
          </div>
          <div class="form-group">
          <label for="tipo">Tipo de Unidad:</label>
          <select class="form-control" id="tipo" name="tipo">
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
          <input type="text" class="form-control" id="unidad" placeholder="Ingrese Unidad" name="unidad" required>
          </div>

          <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
      </div>

  </body>
</html>
<script>
  function getfocus(){
    document.getElementById("id_unidad").focus();
  }
</script>