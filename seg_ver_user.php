<?php 

//bloquear acceso directo por barra de direcciones
if(!isset($_SESSION["user_log"])){
  exit();
}

include_once 'fx.php'; ?>

<div class="container">

      <!-- mostrar usuario -->
      <div class="clearfix">
          <span class="float-right">User: <?php echo $_SESSION["user_log"].' - '.$_SESSION["user_log_rol"]; ?>
      </div>

      <!-- mostrar ciudad si hay seleccionada -->
      <?php 
        if(isset($_SESSION["id_ciudad"])){?>
          <div class="clearfix">
            <span class="float-right">Ciudad: <?php echo ciudad($_SESSION["id_ciudad"])["ciudad"];?></span>
          </div>
          <?php
        }
      ?>

      <!-- mostrar factor si hay seleccionado -->
      <?php 
        if(isset($_SESSION["id_factor"])){
          ?>
          <div class="clearfix">
            <span class="float-right"><?php //echo factor($_SESSION["id_factor"])["factor"];?>
          </div>
          <?php
        }
      ?>
</div>