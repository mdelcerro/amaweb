<?php

function connect() {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $schema = "id5508088_amaweb";

    /*
    //datos base de datos local

    $servername = "localhost";
    $username = "id5508088_amaweb";
    $password = "123456";
    $schema = "id5508088_amaweb";
    */

    // Conectar DB
    $conn = new mysqli($servername, $username, $password);
    mysqli_set_charset($conn,"utf8");

    // Comprobar conexión
    if ($conn->connect_error) {
        die("<p style=\"color:red\">Fallo de conexión: </p><br>" . $conn->connect_error);
    }
    // Seleccionar bd
    $sql = "USE ".$schema;
    if ($conn->query($sql) === FALSE) {
        die("<br><p style=\"color:red\">La BBDD ".$schema." no pudo ser seleccionada: </p><br>" . $conn->error);
    }

    return $conn;
}

function is_logged() {
    return !empty($_SESSION['usuario']);
}

function validate_security() {

    if (!is_logged()) {
        header('Location: acceso.php');
        die();
    }
}

function get_logged() {
    return $_SESSION['usuario'];
}