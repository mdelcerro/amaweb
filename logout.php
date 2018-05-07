<?php
include "functions.php";

//Llamamos a la función session-start para iniciar una nueva sesión
session_start();

// comprobamos que se haya iniciado la sesión
if(is_logged()) {
    session_destroy();

}

header("Location: index.php");
