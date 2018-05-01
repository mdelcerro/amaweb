<?php
$servidor="localhost";
$usuario="id5508088_amaweb";
$password="";
$bbdd="id5508088_amaweb";

//	$servidor = "localhost";
//	$usuario = "root";
//	$password = "";
//	$bbdd = "biblioteca";


$conexion = mysqli_connect($servidor, $usuario, $password, $bbdd) or die ("No se ha podido establecer la conexión");

// 3307 es para conectar con MariaDB
// var_dump($conexion);

mysqli_query($conexion, "SET NAMES 'utf8' ");

// mysqli_set_charset($conexion, 'utf8');    valen las dos formas
if($conexion)
{
	return "Conectado";
}else{
	return "No conectado";
}
?>