<?php

include "config.php";

function connect()
{
    global $cf_db_password, $cf_db_schema, $cf_db_username, $cf_db_servername;

    // Conectar DB
    $conn = new mysqli($cf_db_servername, $cf_db_username, $cf_db_password);
    mysqli_set_charset($conn, "utf8");

    // Comprobar conexión
    if ($conn->connect_error) {
        die("<p style=\"color:red\">Fallo de conexión: </p><br>" . $conn->connect_error);
    }
    // Seleccionar bd
    $sql = "USE " . $cf_db_schema;
    if ($conn->query($sql) === FALSE) {
        die("<br><p style=\"color:red\">La BBDD " . $cf_db_schema . " no pudo ser seleccionada: </p><br>" . $conn->error);
    }

    return $conn;
}

function is_logged()
{
    return !empty($_SESSION['user']);
}

function validate_security()
{

    if (!is_logged()) {
        header('Location: acceso.php');
        die();
    }
}

function get_logged()
{
    return $_SESSION['user'];
}