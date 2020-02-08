<?php

function traer_tablas()
{
    //lista las tablas de la db
    include 'cn_con.php';
    if(gethostname() == 'LAPTOP-0ENCCGH8' or gethostname() == 'fabian-pc'){
        $dbname = "sdv";     // local database name
    }
    else {
        $dbname = "otjnmiwd_sdv";     // smartcities database name
    }

    $sql = "show tables from $dbname";
    return mysqli_query($conn, $sql);
}

function traer_table_comment($tabla)
{
    //trae la table_comment de una tabla
    include 'cn_con.php';
    if(gethostname() == 'LAPTOP-0ENCCGH8' or gethostname() == 'fabian-pc'){
        $dbname = "sdv";     // local database name
    }
    else {
        $dbname = "otjnmiwd_sdv";     // smartcities database name
    }

    $sql = "SELECT table_comment 
            FROM INFORMATION_SCHEMA.TABLES 
            WHERE table_schema='$dbname' AND table_name='$tabla'";
    $qry = mysqli_query($conn, $sql);
    return mysqli_fetch_array($qry)[0];
}


function roles(){
    //lista de roles
    include 'cn_con.php';
    $sql = "select * from seg_roles 
            order by id_rol";
    return mysqli_query($conn, $sql);
}

function rol($id_rol){
    include 'cn_con.php';
    $sql = "select * from seg_roles
            where id_rol = '$id_rol'";
    $qry = mysqli_query($conn, $sql);
    return mysqli_fetch_array($qry);
}

function existe_rol($id_usuario, $id_rol){
    //tiene el usuario un rol determinado?
    include 'cn_con.php';
    $sql = "select * from seg_usuario_rol
            where id_rol  = '$id_rol' and id_usuario = '$id_usuario'";
    $qry = mysqli_query($conn, $sql);
    if(mysqli_num_rows($qry) == 0){
        return false;
    }else{
        return true;
    }
}

function del_roles_usuario($id_usuario){
    include 'cn_con.php';
    $sql = "delete from seg_usuario_rol
            where id_usuario = '$id_usuario'";
    mysqli_query($conn, $sql);
}

function salvar_pass($pass, $id_usuario){
    include 'cn_con.php';
    $sql = "update seg_usuarios
            set pass = '$pass'
            where id_usuario = '$id_usuario'";
    mysqli_query($conn, $sql);
}

function hay_permiso($id_rol, $objeto, $permiso_buscado){
    //verifica si hay un determinado permiso para un objeto
    include 'cn_con.php';
    $sql = "select permisos from seg_roles_accion
            where id_rol = '$id_rol' and objeto = '$objeto'";
    $qry = mysqli_query($conn, $sql);
    $perm = mysqli_fetch_array($qry)[0];
    //stristr imprime el string encontrado y hasta el final
    //strlen mide la longitud del string
    if(strlen(stristr($perm, $permiso_buscado)) > 0){
        return true; //encontró el caracter, hay permiso
    }
    else{
        return false; //no hay permiso
    }
}

function del_permisos($id_rol){
    //eliminar permisos del rol
    include 'cn_con.php';
    $sql = "delete from seg_roles_accion
            where id_rol = '$id_rol'";
    mysqli_query($conn, $sql);
}

function asignar_permiso($id_rol, $objeto, $permisos){
    include 'cn_con.php';
    $sql = "insert into seg_roles_accion
            (id_rol, objeto, permisos) values
            ('$id_rol', '$objeto', '$permisos')";
    mysqli_query($conn, $sql);
}

function usuarios(){
    include 'cn_con.php';
    $sql = "select * from seg_usuarios
            order by id_usuario";
    return mysqli_query($conn, $sql);
}

function usuario($id_usuario){
    include 'cn_con.php';
    $sql = "select * from seg_usuarios
            where id_usuario = '$id_usuario'";
    $qry = mysqli_query($conn, $sql);
    return mysqli_fetch_array($qry);
}

function traer_usuario($user_log){
    include 'cn_con.php';
    $sql = "select * from seg_usuarios
            where usuario = '$user_log'";
    $qry = mysqli_query($conn, $sql);
    return mysqli_fetch_array($qry);
}

function gen_password(){
    //generador de clave aleatoria de inicio
    $clave = "";
    $base = "abcdefghijklmnopqrstuvwxyz=+*%.-0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $max = strlen($base) - 1;
    $cant = 10; //largo de la clave
    for($x = 1; $x <= $cant; $x++){
        $pos_azar = rand(0, $max);
        $clave .= substr($base, $pos_azar, 1);
    }
    return $clave;
}

function pass($usuario){
    //trae el pass y el estado desde la DB, de un usuario determinado
    include 'cn_con.php';
    $sql = "select id_usuario, pass, estado, id_ciudad 
            from seg_usuarios
            where usuario = '$usuario'";
    $qry = mysqli_query($conn, $sql);
    return mysqli_fetch_array($qry);
}

function rol_usu($id_usuario){
    include 'cn_con.php';
    $sql = "select id_rol from seg_usuario_rol
            where id_usuario = '$id_usuario'";
    $qry = mysqli_query($conn, $sql);
    return mysqli_fetch_array($qry)[0];
}

function tiene_rol($id_usuario){
    //verifica si el usuario tiene un rol asignado
    include 'cn_con.php';
    $sql = "select id_rol from seg_usuario_rol
            where id_usuario = '$id_usuario'";
    $qry = mysqli_query($conn, $sql);
    if(mysqli_num_rows($qry) > 0){
        return true;
    }else{
        return false;
    }
}

function rol_usuario($id_usuario){
    include 'cn_con.php';
    $sql = "select rol 
            from seg_roles r inner join seg_usuario_rol u
            on r.id_rol = u.id_rol
            where u.id_usuario = '$id_usuario'";
    $qry = mysqli_query($conn, $sql);
    return mysqli_fetch_array($qry)[0];
}

function permiso($user_log, $accion, $objeto){
    //define si el usuario puede o no realizar una accion sobre un objeto
    //de acuerdo a su rol
    include 'cn_con.php';
    
    //determinar id usuario
    $id_usuario = traer_usuario($user_log)["id_usuario"];
    //determinar sus roles
    $id_rol = rol_usu($id_usuario);
   
    if(hay_permiso($id_rol, $objeto, $accion)){
        return true;
    }else{
        return false;
    }
    
}

function log_respuestas($id_item, $respuesta){
    //almacena actividad respuestas
    include 'cn_con.php';
    $id_usuario = $_SESSION["id_usuario"];
    $id_rol = $_SESSION["id_rol"];
    $id_ciudad = $_SESSION["id_ciudad"];
    $sql = "insert into log_respuestas 
            (id_usuario, id_rol, id_ciudad, id_item, respuesta) values
            ('$id_usuario', '$id_rol', '$id_ciudad', '$id_item', '$respuesta')";
    mysqli_query($conn, $sql);
}

function log_cumplimientos($id_objetivo, $cumplimiento){
    //almacena actividad cumplimiento de objetivos
    include 'cn_con.php';
    $id_usuario = $_SESSION["id_usuario"];
    $id_rol = $_SESSION["id_rol"];
    $sql = "insert into log_cumplimientos 
            (id_usuario, id_rol, id_objetivo, cumplimiento) values
            ('$id_usuario', '$id_rol', '$id_objetivo', '$cumplimiento')";
    mysqli_query($conn, $sql);
}