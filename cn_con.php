<?php
if(gethostname() == 'LAPTOP-0ENCCGH8' or
    gethostname() == 'fabian-pc'){
    //local
    $dbhost = "localhost";	  // localhost or IP
    $dbuser = "root";		  // database username
    $dbpass = "dinamita_67";	  // database password
    $dbname = "sdv";     // database name
}
else {
    //online smartcities
   $dbhost = "localhost";	  // localhost or IP
   $dbuser = "otjnmiwd_otjnmiwd";		  // database username
   $dbpass = '4#$itJ_wbzfR';	  // database password
   $dbname = "otjnmiwd_sdv";     // database name
}

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
//@mysqli_query("SET NAMES 'utf8'"); //selccion de caracteres españoles
?>