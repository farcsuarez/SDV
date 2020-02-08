<?php
//crea un checkbox por cada capa
$capas = capas(); //tomar capas existentes
while($c = mysqli_fetch_array($capas)){
    $id_capa = $c["id_capa"];
    $capa = $c["capa"];?>
    <div class="form-check">
    <label class="form-check-label">
    <input type="checkbox" class="form-check-input" id="capa_<?php echo $id_capa;?>" 
        name="capa_<?php echo $id_capa;?>" value="<?php echo $id_capa;?>"><?php echo $capa;?>
    </label></div><?php 
}?> 