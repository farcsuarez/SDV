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

    //CERROJO: verificar si hay permisos modificar items
    if(!hay_permiso($_SESSION["id_rol"], "items", "M")){

      //  mensaje
      ?>
          <br><div class="container">
          <div class="alert alert-warning">No tiene permisos para esta accion!</div>
      <?php 
      exit();
    }
    // fin CERROJO -----------------------------------------------------

    $id_item = $_GET["id"];
    $item = item($id_item); //array del item a modificar
    $tipo_resp = $item["tipo_resp"];
    $nro_orden = $item["nro_orden"];
    $texto = $item["texto"];
    $id_categoria = $item["id_categoria"];
    $categoria = categoria($id_categoria);
    $descripcion = $item["descripcion"];
    $tipo_num = $item["tipo_num"];
    $rango_inf = $item["rango_inf"];
    $rango_sup = $item["rango_sup"];
    $rango_sup = $item["rango_sup"];
    $unidad = $item["id_unidad"].' - '.unidad($item["id_unidad"])["unidad"];

    $m = traer_capas($id_item); //capas del item, si existen transformar el result $m en un array $mis_capas 
    $mis_capas = array();
    while($i = mysqli_fetch_array($m)){
      array_push($mis_capas, $i["id_capa"]);
    }

    //traer si las hay, las respuestas de lista
    $r_lista = resp_lista($id_item);
    $conta = 0;
    $lista = array();
    $norma = array();
    while($x = mysqli_fetch_array($r_lista)){
        $conta++;                          //retendrá el total de respuestas
        $lista[$conta] = $x["respuesta"];  //array con resp de lista (pasan por Session)
        $norma[$conta] = $x["val_normal"]; //array con valores normalizados (pasan por Session)
    }

    //rellenar lista y norma vacíos para poner sus valores en los controles
    for($i = 1; $i < 5; $i++){
      if(!isset($lista[$i])){
        $lista[$i] = "";
        $norma[$i] = 1;
      }
    }

    $id_factor = $_SESSION["id_factor"];
    $factor = factor($id_factor)["factor"];

    $capas = capas();
    $categorias = categorias();
    $unidades = unidades();

    if($tipo_resp == 'rango de valores'){
      ?>
          <style>
          /* ocultar respuestas de lista */
            #l1, #l2, #l3, #l4, #v1, #v2, #v3, #v4, #b1 {
              display: none; 
            }
          </style>
      <?php
    }else{
      ?>
          <style>
          /* ocultar respuestas de rango numerico */
            #tipo_n, #rinf, #rsup, #uni {
              display: none; 
            }
          </style><?php
    }?>

    <div class="container"><br>
    <div class="alert alert-success">
      Factor actual: <?php echo $id_factor.' - '.$factor;?>
    </div>

    <div class="container">
      <div class="d-inline-flex w-100">
          <div class="w-50"><h2>Form Modificar Item</h2></div>
          <div><a href="abm_items.php" class="btn btn-info" role="button">Volver</a></div>
      </div>  
      <form method="post" action="abm_items_modif_.php">
        <div class="form-group w-25">
          <label for="id_item">id item:</label>
            <input type="text" class="form-control" id="id_item" placeholder="" name="id_item" 
            value="<?php echo $id_item; ?>" readonly>
        </div>
        <div class="form-group w-25">
          <label for="nro_orden">Nro orden:</label>
          <input type="text" class="form-control" id="nro_orden" placeholder="Ingrese nro de Orden" name="nro_orden" 
              value="<?php echo $nro_orden; ?>">
        </div>
        <div class="form-group">
          <label for="texto">Texto:</label>
          <input type="text" class="form-control" id="texto" placeholder="Ingrese texto" name="texto" 
              value="<?php echo $texto; ?>" required>
        </div>
        <div class="form-group w-50">
          <label for="id_categoria">Categoria:</label>
          <select class="form-control" id="id_categoria" name="id_categoria">
            <?php 
            echo '<option>'.$id_categoria.' - '.$categoria.'</option>';
            while($c = mysqli_fetch_array($categorias)){
                echo '<option>'.$c["id_categoria"].' - '.$c["categoria"].'</option>';
            }?>
          </select>
        </div>
        
        <div class="form-group">
          <label>Capas:</label>
          <?php
          while($c = mysqli_fetch_array($capas)){
              $id_capa = $c["id_capa"];
              $capa = $c["capa"];?>
              <div class="form-check">
              <label class="form-check-label">
              
              <?php 
                  //ver si $id_capa existe en array de capas del item ($mis_capas), y marcar checked 
                  if(in_array($id_capa, $mis_capas)){ ?>
                    <input type="checkbox" class="form-check-input" id="capa_<?php echo $id_capa;?>" 
                    name="capa_<?php echo $id_capa;?>" value="<?php echo $id_capa;?>" checked><?php echo $capa;?><?php
                  }else{ ?>
                    <input type="checkbox" class="form-check-input" id="capa_<?php echo $id_capa;?>" 
                    name="capa_<?php echo $id_capa;?>" value="<?php echo $id_capa;?>"><?php echo $capa;?><?php
                  }
              ?>
              
              </label></div><?php 
          }?>
        </div>

        <div class="form-group">
          <label for="descripcion">Descripcion:</label>
          <input type="text" class="form-control" id="descripcion" placeholder="" name="descripcion" 
          value="<?php echo $descripcion;?>">
        </div>
        <div class="form-group w-25">
          <label for="tipo_resp">Tipo de respuesta:</label>
          <select onchange="togg_ocultar()" class="form-control" id="tipo_resp" name="tipo_resp">
            <?php echo '<option>'.$tipo_resp.'</option>'; ?>
            <option>rango de valores</option>
            <option>lista de items</option>
          </select>
        </div>

        <div class="d-inline-flex w-100">
          <div id="tipo_n" class="form-group w-25">
            <label for="tipo_num">Entero/Decimal:</label>
            <select class="form-control" id="tipo_num" name="tipo_num">
            <?php echo '<option>'.$tipo_num.'</option>'; ?>
              <option>entero</option>
              <option>decimal</option>
            </select>
          </div>
          <div id="rinf" class="form-group w-25">
              <label for="rango_inf">Rango inferior:</label>
              <input type="text" class="form-control" id="rango_inf" placeholder="" name="rango_inf" 
                value="<?php echo $rango_inf; ?>" >
          </div>
          <div id="rsup" class="form-group w-25">
              <label for="rango_sup">Rango superior:</label>
              <input type="text" class="form-control" id="rango_sup" placeholder="Ingrese el máximo" name="rango_sup" 
              value="<?php echo $rango_sup; ?>">
          </div>
          <div id="uni" class="form-group w-25">
            <label for="id_unidad">Unidades:</label>
            <select class="form-control" id="id_unidad" name="id_unidad">
            <?php
              echo '<option>'.$unidad.'</option>';
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
              <input type="text" class="form-control" id="lista_1" placeholder="Ingrese respuesta" name="lista_1"
                  value="<?php echo $lista[1]; ?>">
            </div>
            <div id="v1" class="form-group w-25">
              <label for="norma_1">valor normalizado:</label>
              <select class="form-control" id="norma_1" name="norma_1">
              <?php echo '<option>'.$norma[1].'</option>';?>
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
              <input type="text" class="form-control" id="lista_2" placeholder="Ingrese respuesta" name="lista_2"
                      value="<?php echo $lista[2]; ?>">
            </div>
            <div id="v2" class="form-group w-25">
              <label for="norma_2">valor normalizado:</label>
              <select class="form-control" id="norma_2" name="norma_2">
                <?php echo '<option>'.$norma[2].'</option>';?>
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
              <input type="text" class="form-control" id="lista_3" placeholder="Ingrese respuesta" name="lista_3"
                    value="<?php echo $lista[3]; ?>">
            </div>
            <div id="v3" class="form-group w-25">
              <label for="norma_3">valor normalizado:</label>
              <select class="form-control" id="norma_3" name="norma_3">
              <?php echo '<option>'.$norma[3].'</option>';?>
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
              <input type="text" class="form-control" id="lista_4" placeholder="Ingrese respuesta" name="lista_4"
                      value="<?php echo $lista[4]; ?>">
            </div>
            <div id="v4" class="form-group w-25">
              <label for="norma_4">valor normalizado:</label>
              <select class="form-control" id="norma_4" name="norma_4">
              <?php echo '<option>'.$norma[4].'</option>';?>
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
    
        <!--   <a id="b1" href="#" onclick="unamas()">+1 resp de lista</a><br> -->

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
        document.getElementById('rinf').style.display = 'block';
        document.getElementById('rsup').style.display = 'block';
        document.getElementById('uni').style.display = 'block';
    }
}

function unamas(){
  document.getElementById('b1').style.display = 'none';
  document.getElementById('l4').style.display = 'block';
  document.getElementById('v4').style.display = 'block';
}
</script>