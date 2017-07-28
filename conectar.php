<?php

/**
 * @author Silas Figueira
 * @copyright 2014
 */
 
 
//$mysql_host = "dbmy0047.whservidor.com";
//$mysql_database = "eaish_2";
//$mysql_user = "eaish_2";
//$mysql_password = "P10Senha";


 
$mysql_host = "localhost";
$mysql_database = "eaish_2";
$mysql_user = "root";
$mysql_password = "";



$conect=mysql_connect($mysql_host,$mysql_user,$mysql_password);

//mysql_pconnect($mysql_host, $mysql_user ,$mysql_password);

mysql_select_db($mysql_database);
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');


if(!$conect) die ("<h1>Falha na conex�o<h1>" );




?>