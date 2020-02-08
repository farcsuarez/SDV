<?php session_start();?>

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

          //CERROJO: verificar si hay permisos alta items
          if(!hay_permiso($_SESSION["id_rol"], "items", "A")){

            //  mensaje
            ?>
                <br><div class="container">
                <div class="alert alert-warning">No tiene permisos para esta accion!</div>
            <?php 
            exit();
          }
          // fin CERROJO -----------------------------------------------------
      

      $id_factor = $_SESSION["id_factor"];
      $factor = factor($id_factor)["factor"];
      $capas = capas();
      $categorias = categorias();
      $unidades = unidades();
      ?>
      <style>
      /* ocultar respuestas de lista al comienzo */
        #l1, #l2, #l3, #l4, #v1, #v2, #v3, #v4, #b1 {
          display: none; 
        }
      </style>

      <div class="container"><br>
      <div class="alert alert-success">
        <strong>Factor actual: </strong> <?php echo $id_factor.' - '.$factor;?>
      </div>

      <div class="container">
        <h2>Form Registro Alta Items</h2>
        <form method="post" action="abm_items_new_.php">
          <div class="form-group w-25">
            <label for="nro_orden">Nro orden:</label>
            <?php //sugerir orden
                if(isset($_SESSION["nro_orden"])){?>
                  <input type="text" class="form-control" id="nro_orden" placeholder="Ingrese nro de Orden" name="nro_orden"
                  value ="<?php echo $_SESSION["nro_orden"]; ?>"> </div><?php
                }
                else{?>
                  <input type="text" class="form-control" id="nro_orden" placeholder="Ingrese nro de Orden" name="nro_orden">
                  </div><?php
                }?>
            
          <div class="form-group">
            <label for="texto">Texto:</label>
            <input type="text" class="form-control" id="texto" placeholder="Ingrese texto" name="texto" required>
          </div>
          <div class="form-group w-50">
            <label for="id_categoria">Categoria:</label>
            <select class="form-control" id="id_categoria" name="id_categoria">
              <?php 
                //sugerir categoria
                if(isset($_SESSION["categoria"])){
                  echo '<option>'.$_SESSION["categoria"].'</option>';
                }
                while($c = mysqli_fetch_array($categorias)){
                    echo '<option>'.$c["id_categoria"].' - '.$c["categoria"].'</option>';
                }?>
            </select>
          </div>
          
          <div class="form-group">
            <label>Capas:</label>
            <?php include 'capas.php'; ?>
          </div>

          <div class="form-group">
            <label for="descripcion">Descripcion:</label>
            <input type="text" class="form-control" id="descripcion" placeholder="Ingrese una descripcion" name="descripcion">
          </div>
          <div class="form-group w-25">
            <label for="tipo_resp">Tipo de respuesta:</label>
            <select onchange="togg_ocultar()" class="form-control" id="tipo_resp" name="tipo_resp">
              <option>rango de valores</option>
              <option>lista de items</option>
            </select>
          </div>

          <div class="d-inline-flex w-100">
            <div id="tipo_n" class="form-group w-25">
              <label for="tipo_num">Entero/Decimal:</label>
              <select class="form-control" id="tipo_num" name="tipo_num">
                <option>entero</option>
                <option>decimal</option>
              </select>
            </div>
            <div id="rinf" class="form-group w-25">
                <label for="rango_inf">Rango inferior:</label>
                <input type="text" class="form-control" id="rango_inf" placeholder="Ingrese el mínimo" name="rango_inf" >
            </div>
            <div id="rsup" class="form-group w-25">
                <label for="rango_sup">Rango superior:</label>
                <input type="text" class="form-control" id="rango_sup" placeholder="Ingrese el máximo" name="rango_sup" >
            </div>
            <div id="uni" class="form-group w-25">
              <label for="id_unidad">Unidades:</label>
              <select class="form-control" id="id_unidad" name="id_unidad">
              <?php
                while($u = mysqli_fetch_array($unidades)){
                  echo '<option>'.$u["id_unidad"].' - '.$u["unidad"].'</option>';
                }
              ?>
              </select>
            </div>
          </div>    
          
          <div class="d-inline-flex w-100">
              <div id="l1" class="form-group w-75">
                <label for="lista_1">respuesta lista nro 1:</label>
                <input type="text" class="form-control" id="lista_1" placeholder="Ingrese respuesta" name="lista_1">
              </div>
              <div id="v1" class="form-group w-25">
                <label for="norma_1">valor normalizado:</label>
                <select class="form-control" id="norma_1" name="norma_1">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>7</option>
                  <option>8</option>
                  <option>9</option>
                  <option>10</option>
                </select>
              </div>
          </div>

          <div class="d-inline-flex w-100">
              <div id="l2" class="form-group w-75">
                <label for="lista_2">respuesta lista nro 2:</label>
                <input type="text" class="form-control" id="lista_2" placeholder="Ingrese respuesta" name="lista_2">
              </div>
              <div id="v2" class="form-group w-25">
                <label for="norma_2">valor normalizado:</label>
                <select class="form-control" id="norma_2" name="norma_2">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>7</option>
                  <option>8</option>
                  <option>9</option>
                  <option>10</option>
                </select>
              </div>
          </div>
          
          <div class="d-inline-flex w-100">
              <div id="l3" class="form-group w-75">
                <label for="lista_3">respuesta lista nro 3:</label>
                <input type="text" class="form-control" id="lista_3" placeholder="Ingrese respuesta" name="lista_3">
              </div>
              <div id="v3" class="form-group w-25">
                <label for="norma_3">valor normalizado:</label>
                <select class="form-control" id="norma_3" name="norma_3">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>7</option>
                  <option>8</option>
                  <option>9</option>
                  <option>10</option>
                </select>
              </div>
          </div>
      
          <div class="d-inline-flex w-100">
              <div id="l4" class="form-group w-75">
                <label for="lista_4">respuesta lista nro 4:</label>
                <input type="text" class="form-control" id="lista_4" placeholder="Ingrese respuesta" name="lista_4">
              </div>
              <div id="v4" class="form-group w-25">
                <label for="norma_4">valor normalizado:</label>
                <select class="form-control" id="norma_4" name="norma_4">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>7</option>
                  <option>8</option>
                  <option>9</option>
                  <option>10</option>
                </select>
              </div>
          </div>

          <a id="b1" href="#" onclick="unamas()">+1 resp de lista</a><br>

          <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
      </div>

  </body>
</html>

<script>
function togg_ocultar(){
  var combo = document.getElementById("tipo_resp");
  var selected = combo.options[combo.selectedIndex].text;

    if(selected == "lista de items"){
        document.getElementById('l1').style.display='block';
        document.getElementById('l2').style.display='block';
        document.getElementById('l3').style.display='block';
        document.getElementById('v1').style.display='block';
        document.getElementById('v2').style.display='block';
        document.getElementById('v3').style.display='block';
        document.getElementById('b1').style.display='block';
        document.getElementById('tipo_n').style.display='none';
        document.getElementById('rinf').style.display='none';
        document.getElementById('rsup').style.display='none';
        document.getElementById('uni').style.display='none';
    }
    else{
        document.getElementById('l1').style.display = 'none';
        document.getElementById('l2').style.display = 'none';
        document.getElementById('l3').style.display = 'none';
        document.getElementById('l4').style.display = 'none';
        document.getElementById('v1').style.display = 'none';
        document.getElementById('v2').style.display = 'none';
        document.getElementById('v3').style.display = 'none';
        document.getElementById('v4').style.display = 'none';
        document.getElementById('b1').style.display = 'none';
        document.getElementById('tipo_n').style.display = 'block';
        document.getElementById('rinf').style.display = 'inline-block';
        document.getElementById('rsup').style.display = 'inline-block';
        document.getElementById('uni').style.display = 'block';
    }
}

function unamas(){
  document.getElementById('b1').style.display = 'none';
  document.getElementById('l4').style.display = 'block';
  document.getElementById('v4').style.display = 'block';
}
</script>