<?php
session_start();
include 'functions.php';
include 'includes/conexion.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
<title>Panel de Control</title>
  <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="assets/css/main.css" />
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
</head>

<body>
    <?php  draw_header();?>  
    
<h2>Selecciona noticia para borrar o modificar</h2>
<form action="r_comboEntradas.php" method="POST" name="form_entradas">
<select name="entradas">
<option value="" selected disabled>Elige una noticia</option>
<?php

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