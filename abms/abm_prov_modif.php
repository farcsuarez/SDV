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

    //CERROJO: verificar si hay permisos
    if(!hay_permiso($_SESSION["id_rol"], "ci_provincias", "M")){
                
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
        $id_provincia = $_POST["id_provincia"];
        $provincia = $_POST["provincia"];
        $id_pais = trim(explode("-", $_POST["id_pais"])[0]);

        $sql = "update ci_provincias set provincia = '$provincia', id_pais = '$id_pais'
                where id_provincia = '$id_provincia'";

        if(mysqli_query($conn, $sql)){
            ?><br><div class="container">
            <div class="alert alert-success"><?php echo 'Modificacion exitosa de Provincia';?></div>
            <a href="abm_prov.php" class="btn btn-info" role="button">Volver</a></div><?php
        }
        else{
            ?><br><div class="container">
          <div class="alert alert-warning"><?php echo "Error: ".mysqli_error($conn);?></div>
          <a href="abm_prov.php" class="btn btn-info" role="button">Volver</a></div><?php
        }
        exit(); //no recarga form
    }

    $id_provincia = $_GET["id"];
    $obj_prov = provincia($id_provincia);
    $provincia = $obj_prov["provincia"]; //array de una provincia
    $obj_pais = pais($obj_prov["id_pais"]); //pais de esa provincia
    $id_pais = $obj_pais["id_pais"];
    $pais = $obj_pais["pais"];
    $paises = paises(); //todos los paises
    ?>

    <div class="container">
      <h2>Form Modificar Prov/Estado</h2>
      <a href="abm_prov.php" class="btn btn-info" role="button"> volver</a>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group">
          <label for="id_provincia">id Prov/Est:</label>
          <input type="text" class="form-control" id="id_provincia" placeholder="" 
            name="id_provincia" value="<?php echo $id_provincia; ?>" readonly>
        </div>
        <div class="form-group">
          <label for="provincia">Prov/Estado:</label>
          <input type="text" class="form-control" id="provincia" placeholder="" 
            name="provincia" value="<?php echo $provincia; ?>" required>
        </div>
        <div class="form-group">
          <label for="id_pais">Pais:</label>
          <select class="form-control" id="id_pais" placeholder="" name="id_pais">
            <option><?php echo $id_pais.' - '.$pais; ?></option>
            <?php
                $paises = paises();
                while($p = mysqli_fetch_array($paises)){
                    echo '<option>'.$p["id_pais"].' - '.$p["pais"].'</option>';
                } 
            ?>
          </select>  
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </form>
    </div>

  </body>
</html>
