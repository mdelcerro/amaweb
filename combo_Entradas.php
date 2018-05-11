<?php
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Modifica noticias</title>
</head>
<body>
<form action="r_comboEntradas.php" method="POST" name="form_entradas">
<select name="entradas">
<option value="" selected disabled>Elige una noticia</option>
<?php
include "includes/conexion.php";
$sql_select_entradas = "SELECT DISTINCT titulo FROM rss order by fecha DESC";
$eje_select_entradas = mysqli_query($conexion,$sql_select_entradas) or die ("No se puede hacer la selección");

while($entradas = mysqli_fetch_row($eje_select_entradas))
{
	?><option value="<?php echo $entradas[0]; ?>"><?php echo $entradas[0]; ?></option>
 <?php  
}
?>
<input name="enviar" type="submit" value="enviar">

    <br /><br />
    <a href="index.php">Volver al inicio</a>
</body>
</html>