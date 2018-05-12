<?php

include "config.php";
//Llamamos a la función session-start para iniciar una nueva sesión
session_start();

function connect()
{
    global $cf_db_password, $cf_db_schema, $cf_db_username, $cf_db_servername;
/*
    // Conectar DB
    $conn = new mysqli($cf_db_servername, $cf_db_username, $cf_db_password);
    mysqli_set_charset($conn, "utf8");
*/
    $servidor="localhost";
    $usuario="id5508088_amaweb";
    $password="amaweb444";
    $bbdd="id5508088_amaweb";
    $conn = mysqli_connect($servidor, $usuario, $password, $bbdd) or die ("No se ha podido establecer la conexión");
    
    mysqli_query($conn, "SET NAMES 'utf8' ");



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

function draw_header() {
    if (is_logged()) {
        draw_header_logged();
    } else {
        draw_header_logout();
    }
}

function draw_header_logged() {
    echo "<div id=\"header-wrapper\">
        <header id=\"header\" class=\"container\">

            <!-- Logo -->
            <div id=\"logo\">
                <a href=\"index.php\"><img src=\"images/logo.png\" alt=\"logo\" width=\"100px\"></a>
            </div>


            <!-- Nav -->
            <nav id=\"nav\">
                <ul>
                    <li class=\"inactive\"><a href=\"index.php\">Cómo funciona</a></li>
                    <li class=\"inactive\"><a href=\"panel-control.php\">RSS</a></li>
                    <li class=\"inactive\"><a href=\"perfil.php\">Perfil</a></li>
                    <li class=\"inactive\"><a href=\"logout.php\">Salir</a></li>
                </ul>
            </nav>

        </header>
    </div>";
}

function draw_header_logout() {
    echo "<div id=\"header-wrapper\">
        <header id=\"header\" class=\"container\">

            <!-- Logo -->
            <div id=\"logo\">
                <a href=\"index.php\"><img src=\"images/logo.png\" alt=\"logo\" width=\"100px\"></a>
            </div>


            <!-- Nav -->
            <nav id=\"nav\">
                <ul>
                    <li class=\"inactive\"><a href=\"index.php\">Cómo funciona</a></li>
                    <li class=\"inactive\"><a href=\"registro.php\">Registro</a></li>
                    <li class=\"inactive\"><a href=\"acceso.php\">Inicia sesión</a></li>
                </ul>
            </nav>

        </header>
    </div>";
}