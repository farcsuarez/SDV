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

    //CERROJO: verificar si hay permisos
    if(!hay_permiso($_SESSION["id_rol"], "ci_provincias", "A")){
                
      //  mensaje
      ?>
          <br><div class="container">
          <div class="alert alert-warning">No tiene permisos para esta accion!</div>
          <a href="abm_prov.php" class="btn btn-info" role="button"> volver</a>
      <?php 
      exit();
    }
    // fin CERROJO -----------------------------------------------------

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $provincia = $_POST["provincia"];
        $id_pais = $_POST["id_pais"];

        $sql = "insert into ci_provincias (provincia, id_pais) 
                values ('$provincia', '$id_pais')";
        if(mysqli_query($conn, $sql)){
            ?><br><div class="container">
            <div class="alert alert-success"><?php echo 'Alta exitosa de Provincia';?></div>
            <a href="abm_prov.php" class="btn btn-info" role="button">Volver</a></div><?php
        }
        else{
            ?><br><div class="container">
          <div class="alert alert-warning"><?php echo "Error: ".mysqli_error($conn);?></div>
          <a href="abm_prov.php" class="btn btn-info" role="button">Volver</a></div><?php
        }
        exit(); //no recarga form
    }
    ?>

    <div class="container">
      <h2>Form Registro Alta Prov/Estado</h2>
      <a href="abm_prov.php" class="btn btn-info" role="button"> volver</a>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group">
          <label for="provincia">Prov/Estado:</label>
          <input type="text" class="form-control" id="provincia" placeholder="Ingrese Provincia" name="provincia" required>
        </div>
        <div class="form-group">
        <label for="id_pais">Paises:</label>
        <select class="form-control" id="id_pais" name="id_pais">
          <?php
            $paises = paises();
            while($p = mysqli_fetch_array($paises)){
              $id_pais = $p["id_pais"];
              $pais = $p["pais"];
              echo '<option>'.$id_pais.' - '.$pais.'</option>';
            }?>
        </select>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </form>
    </div>
  </body>
</html>
