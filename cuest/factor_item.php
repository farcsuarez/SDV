<?php 
$id_item = $_SESSION["id_item"]; //tomar pregunta seleccionada
$id_factor = $_SESSION["id_factor"]; //tomar factor seleccionado
$factor = factor($id_factor)["factor"];
$texto = item($id_item)["texto"]; //array con la pregunta
?>

<br>
<div class="alert alert-success">
  <strong>Factor actual: </strong> <?php echo $id_factor.' - '.$factor;?><hr>
  Pregunta: <?php echo $texto;?>
</div>