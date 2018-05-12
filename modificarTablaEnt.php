<?php
session_start();
include "includes/conexion.php";
$titu=$_GET['recogiendo0'];

$enlace=$_GET['recogiendo1'];
$fech=$_GET['recogiendo2'];
?>
	<h1>Modificar datos de la noticia </h1>
	<form name="formResultado" action="r_modificarTablaEnt.php" method="post">
        <input name="d_titu" type="text" value="<?php echo $titu;?>">
   
 		<input name="d_enlace" type="text"  value="<?php echo $enlace;?>">
        <input name="d_fech" type="text" readonly value="<?php echo $fech;?>">
	<input name="btnmodificar" type="submit" value="Modificar">        
    </form>

<br /><br />
<a href="index.php">Volver al inicio</a>