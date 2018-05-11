<?php
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Respuesta combo entradas</title>
</head>
<body>
<?php
include "includes/conexion.php";
$tit = $_POST['entradas'];
$sql_select = "SELECT titulo, usuario, enlace, fecha from rss where titulo='$tit'";
$eje_select = mysqli_query($conexion, $sql_select) or die ("No se puede realizar la conexion");
?>
<table id='tabla' width="800" border="1">
<th>Titulo</th><th>Usuario</th><th>Enlace</th><th>Fecha publicación</th><th>BORRAR</th><th>MODIFICAR</th>
 <?php      
		while($rgto = mysqli_fetch_row($eje_select))
		{
			?>
         <tr>
         	<td><?php echo $rgto[0];?></td>
         	<td><?php echo $rgto[1];?></td>
            <td><?php echo $rgto[2];?></td>
             <td><?php echo $rgto[3];?></td>
         	
            <td><a href="borrarTablaEnt.php?recogiendo0=<?php echo $rgto[0] ?>">BORRAR</a></td>
            <td><a href="modificarTablaEnt.php?recogiendo0=<?php echo $rgto[0] ?>&recogiendo1=<?php echo $rgto[1] ?>&recogiendo2=<?php echo $rgto[2] ?>&recogiendo3=<?php echo $rgto[3] ?>">MODIFICAR</a></td>
    	 </tr>
		 <?php 
		}
		?>
</table>
</body>
</html>