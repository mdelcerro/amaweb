
<?php
//session_start();

include "includes/conexion.php";
$borra = $_GET['recogiendo0'];
$sql_baja = "delete from rss where titulo='$borra'";
mysqli_query($conexion,$sql_baja);//hago el delete porque sabemos q el registro existe ya q viene de la tabla
echo "Registro eliminado<br />";
echo "<a href='combo_Entradas.php'>Seguir modificanco noticias</a>";
?>