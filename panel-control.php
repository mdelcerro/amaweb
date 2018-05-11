<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

} else {
   echo "Esta pagina es solo para usuarios registrados.<br>";
   echo "<br><a href='login.html'>Login</a>";
   echo "<br><br><a href='registro.php'>Registrarme</a>";

exit;
}

$now = time();

if($now > $_SESSION['expire']) {
session_destroy();

echo "Su sesion a terminado,
<a href='login.html'>Necesita hacer Login</a>";
exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
<title>Panel de Control</title>
</head>

<body>
<h1>Panel de control de noticias</h1>


<ul>
  <li><a href=formInsertaNews.php>Agregar noticia</a></li>
  <li><a href=combo_Entradas.php>Modificar noticias</li>

</ul>

<br><br>
<a href=logout.php>Cerrar Sesion X </a>
</body>
</html>

<br /><br />
<a href="index.php">Volver al inicio</a>