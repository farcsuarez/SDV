<?php
if(!isset($_SESSION["user_log"])){
    include 'top.php';
    ?>
    <br><br><br><div class="container d-flex flex-column">
    <a href="seg_login.php" class="btn btn-info" role="button">LOGIN</a>
    <div>
    <?php
    exit();
}
?>