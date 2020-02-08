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
      if(!hay_permiso($_SESSION["id_rol"], "it_categorias", "M")){
              
        //  mensaje
        ?>
            <br><div class="container">
            <div class="alert alert-warning">No tiene permisos para esta accion!</div>
            <a href="abm_cat.php" class="btn btn-info" role="button"> volver</a>
        <?php 
        exit();
      }
      // fin CERROJO -----------------------------------------------------

    $idcat = $_GET["idcat"];?>

      <div class="container">
        <h2>Form Modifica Categoria</h2>
        <form method="post" action="abm_cat_modif_.php">
          <div class="form-group">
              <label for="id_categoria">Id Categoria:</label>
              <input type="text" class="form-control" id="id_categoria" placeholder="Ingrese Categoria" name="id_categoria" value="<?php echo $idcat;?>" readonly>
          </div>
          <div class="form-group">
            <label for="id_dimension">Categoria:</label>
            <input type="text" class="form-control" id="categoria" placeholder="Ingrese Categoria" name="categoria" value="<?php echo categoria($idcat);?>" required>
          </div>
          <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
      </div>

  </body>
</html>

