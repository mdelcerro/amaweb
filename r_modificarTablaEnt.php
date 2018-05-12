<?php
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Update</title>
</head>
<body>
<?php
include "includes/conexion.php";

//RECOJO LOS NUEVOS DATOS DEL FORMULARIO PARA EDITAR EL REGISTRO

$ti=$_POST['d_titu'];
$en=$_POST['d_enlace'];
$fe=$_POST['d_fech'];

//SENTENCIA UPDATE > Vamos a coger los datos nuevos y modificarlo en la base de datos
$sql_update="UPDATE rss SET titulo='$ti',  enlace='$en' WHERE fecha='$fe'";

//EJECUTAR EL UPDATE

$ejec_update=mysqli_query($conexion, $sql_update) or die ("No se puede realizar el cambio.");


?>
<table border="1px">
	<th>TITULO</th>
    <th>ENLACE</th>
	<th>FECHA</th>
    
    <tr>
		<td><?php echo $ti;?></td>
	  	<td><?php echo $en;?></td>
        <td><?php echo $fe;?></td>
    </tr>       
</table>
<a href="combo_Entradas.php">Seguir modificando</a>

</body>
</html>