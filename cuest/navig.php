<nav class="navbar navbar-expand-sm bg-light">
    <!-- Links -->
    <ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="../index.php">Home</a>
    </li>
    <!-- <li class="nav-item">
        <a class="nav-link" href="abms/main.php" disabled>ABMs</a>
    </li> -->
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">ABMs</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="../abms/abm_dim.php">Dimensiones</a>
          <a class="dropdown-item" href="../abms/abm_eje.php">Ejes</a>
          <a class="dropdown-item" href="../abms/abm_fac.php">Factores</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="../abms/abm_pon.php">Ponderaciones</a>
        </div>
    </li>
    <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">ITEMS</a>
          <div class="dropdown-menu">
          <a class="dropdown-item" href="abm_items.php">ABM Items</a>
          <a class="dropdown-item" href="abm_resp.php">Responder</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="abm_inic.php">Iniciativas/Objetivos</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="abm_cat.php">Categorias</a>
          <a class="dropdown-item" href="abm_cap.php">Capas</a>
          <a class="dropdown-item" href="abm_uni.php">Unidades</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="../abms/abm_pais.php">Paises</a>
          <a class="dropdown-item" href="../abms/abm_prov.php">Provincias</a>
          <a class="dropdown-item" href="../abms/abm_ciu.php">Ciudades</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Seguridad</a>
        <div class="dropdown-menu">
        <a class="dropdown-item" href="../seg_abm_rol.php">Roles</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="../seg_abm_usu.php">ABM Usuarios</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="../seg_logout.php">LogOut</a>
        </div>
    </li>
    </ul>
</nav>

<?php include '../seg_ver_user.php'; ?>