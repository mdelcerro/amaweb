<?php
include "functions.php";

validate_security();

$id = get_logged();

// Conectar DB
$conn = connect();

// Ejecutar delete
$sql = "DELETE FROM usuarios WHERE idusuario=?";

// Vincular variables a una instrucción preparada como parámetros
$stmt = $conn->prepare($sql);
$stmt->bind_param('d', $id);

if ($stmt->execute() === FALSE) {
    die("<br><p style=\"color:red\">No se ha podido borrar al usuario: </p><br>" . $conn->error);
}
// Cerrar sentencia
$stmt->close();

// cerrar conexion
$conn->close();

session_destroy();
header("Location: index.php");
