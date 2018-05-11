<?php
session_start();
?>

<?php

$host_db = "localhost";
$user_db = "id5724689_vicuser";
$pass_db = "amaweb444";
$db_name = "id5724689_vic";
$tbl_name = "usuarios";

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}

$usuario = $_POST['usuario'];
$password = $_POST['password'];

 
$sql = "SELECT * FROM $tbl_name WHERE usuario = '$usuario'";

$result = $conexion->query($sql);






if ($result->num_rows > 0) {     
 }
 $row = $result->fetch_array(MYSQLI_ASSOC);
 if ($password == $row['password']) {



    $_SESSION['loggedin'] = true;
    $_SESSION['usuario'] = $usuario;
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);

    echo "Wellcome! " . $_SESSION['usuario'];
    echo "<br><br><a href=panel-control.php>Panel de control de noticias</a>";

 } else {
   echo "Username o Password están incorrectos.";

   echo "<br><a href='login.html'>Volver a Intentarlo</a>";
 }
 mysqli_close($conexion); 
 ?>