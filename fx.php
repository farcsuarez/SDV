<?php

function dimensiones(){
    include 'cn_con.php';
    $sql = "select * from dimensiones order by id_dimension";
    return mysqli_query($conn, $sql);
}

function dimension($id_dimension){
    include 'cn_con.php';
    $sql = "select * from dimensiones 
            where id_dimension='$id_dimension'";
    $qry = mysqli_query($conn, $sql);
    return mysqli_fetch_array($qry); //retorno array
}

function ejes(){
    include 'cn_con.php';
    $sql = "select * from ejes
            order by id_eje";
    return mysqli_query($conn, $sql);
}

function ejes_dim($id_dimension){
    include 'cn_con.php';
    $sql = "select * from ejes
            where id_dimension = '$id_dimension'
            order by id_eje";
    return mysqli_query($conn, $sql);
}

function eje($id_eje){
    include 'cn_con.php';
    $sql = "select * from ejes
    where id_eje = '$id_eje'";
    $qry = mysqli_query($conn, $sql);
    return mysqli_fetch_array($qry); 
}

function factores(){
    include 'cn_con.php';
    $sql = "select * from factores
    order by id_factor";
    return mysqli_query($conn, $sql);
}

function fact_max_id(){
    include 'cn_con.php';
    $sql = "select id_factor from factores
    order by id_factor desc";
    $qry = mysqli_query($conn, $sql);
    return mysqli_fetch_array($qry)[0]; //retorna mayor id_factor
}

function factores_eje($id_eje){
    include 'cn_con.php';
    $sql = "select * from factores
    where id_eje = '$id_eje'
    order by id_factor";
    return mysqli_query($conn, $sql);
}

function factor($id_factor){
    include 'cn_con.php';
    $sql = "select * from factores
    where id_factor = '$id_factor'";
    $qry = mysqli_query($conn, $sql);
    return mysqli_fetch_array($qry);
}

function factor_full($id_factor){
    //leyenda dimension-eje-factor
    include 'cn_con.php';
    $f = factor($id_factor);
    $factor = $f["factor"]; //tomar leyenda

    //buscar eje padre del factor 
    $id_eje = $f["id_eje"];
    $e = eje($id_eje);
    $eje = $e["eje"]; //tomar leyenda

    //buscar dimension padre del eje
    $id_dim = $e["id_dimension"];
    $d = dimension($id_dim);
    $dimension = $d["dimension"]; //tomar leyenda

    return $dimension.' - '.$eje.' - '.$factor;
}

function ciudades(){
    include 'cn_con.php';
    $sql = "select * from ci_ciudades
    order by ciudad";
    return mysqli_query($conn, $sql);
}

function ciudad($id_ciudad){
    include 'cn_con.php';
    $sql = "select * from ci_ciudades 
    where id_ciudad = '$id_ciudad'";
    $qry = mysqli_query($conn, $sql);
    return mysqli_fetch_array($qry);
}

function niveles(){
    include 'cn_con.php';
    $sql = "select * from niveles
    order by id_nivel";
    return mysqli_query($conn, $sql);
}

function nivel($id_nivel){
    include 'cn_con.php';
    $sql = "select * from niveles
    where id_nivel = '$id_nivel'";
    $qry = mysqli_query($conn, $sql);
    return mysqli_fetch_array($qry);
}

function paises(){
    include 'cn_con.php';
    $sql = "select * from ci_pais 
    order by pais";
    return mysqli_query($conn, $sql);
}

function pais($id_pais){
    include 'cn_con.php';
    $sql = "select * from ci_pais 
    where id_pais = '$id_pais'";
    $qry = mysqli_query($conn, $sql);
    return mysqli_fetch_array($qry);
}

function provincias(){
    include 'cn_con.php';
    $sql = "select * from ci_provincias 
    order by id_pais, provincia";
    return mysqli_query($conn, $sql);
}

function provincia($id_provincia){
    include 'cn_con.php';
    $sql = "select * from ci_provincias 
    where id_provincia = '$id_provincia'";
    $qry = mysqli_query($conn, $sql);
    return mysqli_fetch_array($qry);
}

function categorias(){
    include 'cn_con.php';
    $sql = "select * from it_categorias
            order by categoria";
     return mysqli_query($conn, $sql);
}

function categoria($id_categoria){
    include 'cn_con.php';
    $sql = 
    "select categoria from it_categorias
     where id_categoria = '$id_categoria'";
     $qry = mysqli_query($conn, $sql);
     return mysqli_fetch_array($qry)[0]; //valor
}

function capas(){
    include 'cn_con.php';
    $sql = "select * from it_capas
        order by id_capa";
    return mysqli_query($conn, $sql);
}

function capa($id_capa){
    include 'cn_con.php';
    $sql = "select * from it_capas
        where id_capa = '$id_capa'";
    $qry = mysqli_query($conn, $sql);
    return mysqli_fetch_array($qry); //array
}

function traer_capas($id_item){
    include 'cn_con.php';
    $sql = "select id_capa from it_capas_items
        where id_item = '$id_item'";
    return mysqli_query($conn, $sql);
}

function traer_capas_inic($id_iniciativa){
    //devuelve un array con las capas de la iniciativa
    include 'cn_con.php';
    $sql = "select id_capa from in_capas_inic
        where id_iniciativa = '$id_iniciativa'";
    $qry = mysqli_query($conn, $sql);

    $arr_cap = array();
    while($c = mysqli_fetch_array($qry)){
        array_push($arr_cap, $c["id_capa"]);
    }

    return $arr_cap;
}

function ponderacion($tipo_elemento, $id_elemento, $id_nivel){
    include 'cn_con.php';
    $sql = "select * from ponderaciones
            where tipo_elemento = '$tipo_elemento' and id_elemento = '$id_elemento'
            and id_nivel = '$id_nivel'";
    $qry = mysqli_query($conn, $sql);
    if(mysqli_num_rows($qry) == 0){
        return 'n/a';
    }else{
        return mysqli_fetch_array($qry)["ponderacion"]; 
    }
}

function hay_ponderacion($tipo_elemento, $id_elemento, $id_nivel){
    include 'cn_con.php';
    $sql = "select * from ponderaciones
            where tipo_elemento = '$tipo_elemento' and id_elemento = '$id_elemento'
            and id_nivel = '$id_nivel'";
    $qry = mysqli_query($conn, $sql);
    if(mysqli_num_rows($qry) == 0){
        return false;
    }else{
        return true; 
    }
}

function almacenar_pond($tipo_elemento, $id_elemento, $id_nivel, $pond){
    //almacenar ponderacion
    include 'cn_con.php';
    if(hay_ponderacion($tipo_elemento, $id_elemento, $id_nivel)){
        $sql = "update ponderaciones set ponderacion = '$pond'
                where tipo_elemento = '$tipo_elemento' and id_elemento = '$id_elemento'
                and id_nivel = '$id_nivel'";
    }else{
        $sql = "insert into ponderaciones
                (tipo_elemento, id_elemento, id_nivel, ponderacion) values 
                ('$tipo_elemento', '$id_elemento', '$id_nivel', '$pond')";
    }
    mysqli_query($conn, $sql);
}

function crear_areas(){
    //sin usar, solo queda como ejemplo
    //unificar dimensiones, ejes y factores en una sola tabla en memoria, t_area
    include 'cn_con.php';
    $sql_elim = "delete from t_area";
    mysqli_query($conn, $sql_elim);

    $sql_dim = "insert into t_area
            (tipo, id_dimension, dimension)
            select 'DIM', id_dimension, dimension 
            from dimensiones
            order by id_dimension";
    mysqli_query($conn, $sql_dim);

    $sql_eje = "insert into t_area
            (tipo, id_dimension, dimension, id_eje, eje)
            select 'EJE', e.id_dimension, d.dimension, e.id_eje, e.eje 
            from ejes e inner join dimensiones d
            on e.id_dimension = d.id_dimension
            order by e.id_dimension, e.id_eje";
    mysqli_query($conn, $sql_eje);

    $sql_fac = "insert into t_area
            (tipo, id_dimension, dimension, id_eje, id_factor, factor)
            select 'FAC', f.id_dimension, d.dimension, f.id_eje, f.id_factor, f.factor
            from factores f inner join dimensiones d
            on f.id_dimension = d.id_dimension
            order by f.id_dimension, f.id_eje, f.id_factor";
    mysqli_query($conn, $sql_fac);
}

function areas()
{
    include 'cn_con.php';
    $sql = "select * from t_area";
    return mysqli_query($conn, $sql);
}

function items($id_factor)
{
    include 'cn_con.php';
    $sql = "select * from items
            where id_factor = '$id_factor'
            order by id_categoria, nro_orden";
    return mysqli_query($conn, $sql);
}

function hay_items($id_factor)
{
    include 'cn_con.php';
    $sql = "select * from items
            where id_factor = '$id_factor'";
    $qry = mysqli_query($conn, $sql);
    if(mysqli_num_rows($qry) > 0){
        return true;
    }
    else{
        return false;
    }
}

function items_todos()
{
    include 'cn_con.php';
    $sql = "select * from items
            order by id_item";
    return mysqli_query($conn, $sql);
}

function item($id_item)
{
    include 'cn_con.php';
    $sql = "select * from items
            where id_item = '$id_item'";
    $qry = mysqli_query($conn, $sql);
    return mysqli_fetch_array($qry);
}

function del_item($id_item)
{
    //eliminar item y dependencias
    include 'cn_con.php';
    //eliminar dependencia respuestas de lista
    del_listas($id_item);
    //eliminar dependencia capas 
    del_capas($id_item);

    $sql = "delete from items
            where id_item = '$id_item'";
    return mysqli_query($conn, $sql);
}

function resp_lista($id_item)
{
    //traer las respuestas posibles de lista para el item
    include 'cn_con.php';
    $sql = "select * from it_lista
            where id_item = '$id_item'";
    return mysqli_query($conn, $sql);
}

function resp_item($id_item, $id_ciudad)
{
    //traer la respuesta para el item-ciudad
    include 'cn_con.php';
    $sql = "select * from respuestas
            where id_item = '$id_item' and id_ciudad = '$id_ciudad'";
    $qry = mysqli_query($conn, $sql);
    return mysqli_fetch_array($qry);
}

function respuesta($pk)
{
    include 'cn_con.php';
    $sql = "select * from it_lista
            where pk = '$pk'";
    $qry = mysqli_query($conn, $sql);
    return mysqli_fetch_array($qry);
}

function unidades()
{
    include 'cn_con.php';
    $sql = "select * from it_unidades
            order by tipo, unidad";
    return mysqli_query($conn, $sql);
}

function unidad($id_unidad)
{
    include 'cn_con.php';
    $sql = "select * from it_unidades
            where id_unidad = '$id_unidad'";
    $qry = mysqli_query($conn, $sql);
    return mysqli_fetch_array($qry);
}

function ins_lista($id_item, $respuesta, $val_normal)
{
    include 'cn_con.php';
    $sql = "insert into it_lista
            (id_item, respuesta, val_normal) values
            ('$id_item', '$respuesta', '$val_normal')";
    mysqli_query($conn, $sql);
}

function del_listas($id_item){
    //eliminar respuestas de lista de un item
    include 'cn_con.php';
    $sql_elim = "delete from it_lista
                 where id_item = '$id_item'";
    mysqli_query($conn, $sql_elim);
}

function ins_capas($id_item, $id_capa)
{
    include 'cn_con.php';
    $sql = "insert into it_capas_items
            (id_item, id_capa) values
            ('$id_item', '$id_capa')";
    mysqli_query($conn, $sql);
}

function del_capas($id_item){
    //eliminar capas de un item
    include 'cn_con.php';
    $sql = "delete from it_capas_items
            where id_item = '$id_item'";
    mysqli_query($conn, $sql);
}

function iniciativas()
{
    include 'cn_con.php';
    $sql = "select * from in_iniciativas
            order by id";
    return mysqli_query($conn, $sql);
}

function iniciativa($id_iniciativa)
{
    include 'cn_con.php';
    $sql = "select * from in_iniciativas
            where id = '$id_iniciativa'";
    $qry = mysqli_query($conn, $sql);
    return mysqli_fetch_array($qry);
}

function inic_factor($id_factor, $id_ciudad)
{
    //traer las iniciativas de un factor y ciudad
    include 'cn_con.php';
    $sql = "select * from in_iniciativas
            where id_factor = '$id_factor' and id_ciudad = '$id_ciudad'
            order by id";
    return mysqli_query($conn, $sql);
}

function ins_capas_inic($id_iniciativa, $id_capa)
{
    include 'cn_con.php';
    $sql = "insert into in_capas_inic
            (id_iniciativa, id_capa) values
            ('$id_iniciativa', '$id_capa')";
    mysqli_query($conn, $sql);
}

function del_capas_inic($id_iniciativa)
{
    include 'cn_con.php';
    $sql = "delete from in_capas_inic
            where id_iniciativa = '$id_iniciativa'";
    mysqli_query($conn, $sql);
}

function estado($id_estado)
{
    include 'cn_con.php';
    $sql = "select * from in_estados
            where id = '$id_estado'";
    $qry = mysqli_query($conn, $sql);
    return mysqli_fetch_array($qry);
}

function estados()
{
    include 'cn_con.php';
    $sql = "select * from in_estados
            order by id";
    return mysqli_query($conn, $sql);
}

function objetivos($id_iniciativa)
{
    //lista objetivos por iniciativa -puede haber varios
    include 'cn_con.php';
    $sql = "select * from in_objetivos
            where id_iniciativa = '$id_iniciativa'        
            order by id_objetivo";
    return mysqli_query($conn, $sql);
}

function objetivo($id_objetivo)
{
    include 'cn_con.php';
    $sql = "select * from in_objetivos
            where id_objetivo = '$id_objetivo'";
    $qry = mysqli_query($conn, $sql);
    return mysqli_fetch_array($qry);
}

function suma_aporte_objetivo($id_iniciativa)
{
    //suma el total de aportes de objetivos a una iniciativa,
    //no puede superar el 100%
    include 'cn_con.php';
    $sql = "select COALESCE(SUM(objetivo_porc), 0) from in_objetivos
            where id_iniciativa = '$id_iniciativa'";
    $qry = mysqli_query($conn, $sql);
    return mysqli_fetch_array($qry)[0]; 
}

function suma_aporte_obj($id_iniciativa, $id_objetivo)
{
    //suma el total de aportes de objetivos a una iniciativa,
    //excepto el objetivo del parametro (para modificacion de objetivos)
    include 'cn_con.php';
    $sql = "select COALESCE(SUM(objetivo_porc), 0) from in_objetivos
            where id_iniciativa = '$id_iniciativa' and id_objetivo <> '$id_objetivo'";
    $qry = mysqli_query($conn, $sql);
    return mysqli_fetch_array($qry)[0]; 
}

function del_objetivo($id_objetivo)
{
    include 'cn_con.php';
    $sql = "delete from in_objetivos
            where id_objetivo = '$id_objetivo'";
    return mysqli_query($conn, $sql); //retorna false si falla, true si tiene exito
}

function cant_resp($id_ciudad, $id_factor){
    //cantidad de items respondidos, de un factor y ciudad dados 
    include 'cn_con.php';
    $sql = "select count(*) 
            from respuestas r inner join items i
            on r.id_item = i.id_item
            where i.id_factor = '$id_factor' and r.id_ciudad = '$id_ciudad'";
    $qry = mysqli_query($conn, $sql);
    return mysqli_fetch_array($qry)[0];
}

function cant_preg($id_factor){
    //cantidad de items declarados de un factor
    include 'cn_con.php';
    $sql = "select count(*) from items
            where id_factor = '$id_factor'";
    $qry = mysqli_query($conn, $sql);
    return mysqli_fetch_array($qry)[0];
}

function cant_objetivos($id_iniciativa){
    //cantidad de objetivos de una iniciativa
    include 'cn_con.php';
    $sql = "select count(*) from in_objetivos
            where id_iniciativa = '$id_iniciativa'";
    $qry = mysqli_query($conn, $sql);
    return mysqli_fetch_array($qry)[0];
}

function cant_inic_factor($id_factor, $id_ciudad){
     //cantidad de iniciativas de un factor y ciudad
     include 'cn_con.php';
     $sql = "select count(*) from in_iniciativas
             where id_factor = '$id_factor' and id_ciudad = '$id_ciudad'";
     $qry = mysqli_query($conn, $sql);
     return mysqli_fetch_array($qry)[0];
}

function resp_old($id_item, $id_ciudad){
    //trae la respuesta de un item y ciudad
    include 'cn_con.php';
    $sql = "select respuesta from respuestas
            where id_item = '$id_item' and id_ciudad = '$id_ciudad'";
    $qry = mysqli_query($conn, $sql);
    return mysqli_fetch_array($qry)[0];
}