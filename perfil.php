<?php

include 'functions.php';

validate_security();

$usuario = $email = $password = $repassword = "";
$id = get_logged();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $error = false;

    if (empty($_POST["user"])) {
        $userError = "<div style=\"text-align:center\"><br><b style=\"color:red\">Introduce un usuario.</b><br /></div>";
        echo $userError;
        $error = true;
    } else {
        $usuario = trim($_POST["user"]);
    }

    if (empty($_POST["email"])) {
        $emailError = "<div style=\"text-align:center\"><br><b style=\"color:red\">Introduce una dirección de correo electrónico.</b><br /></div>";
        echo $emailError;
        $error = true;
    } else {
        $email = trim($_POST["email"]);
    }

    if (!empty($_POST["password"])) {

        $password = trim($_POST["password"]);
        if (empty($_POST["repassword"]) || ($_POST["password"]!=$_POST["repassword"])) {

            $repasswordError = "<div style=\"text-align:center\"><br><b style=\"color:red\">Verifica la contraseña.</b><br /></div>";
            echo $repasswordError;
            $error = true;
        } else {
            $repassword = trim($_POST["repassword"]);
        }
    }


    if (!$error) {

        // Conectar DB
        $conn = connect();

        // Ejecutar update
        $sql = empty($password) ?
            "UPDATE usuarios SET usuario=?, email=? WHERE idusuario=?" :
            "UPDATE usuarios SET usuario=?, email=?, password=? WHERE idusuario=?";

        // Vincular variables a una instrucción preparada como parámetros
        $stmt = $conn->prepare($sql);

        if (empty($password)) {
            $stmt->bind_param('ssd', $usuario, $email, $id);
        } else {
            $stmt->bind_param('sssd', $usuario, $email, $password, $id);
        }

        if ($stmt->execute() === FALSE) {
            die("<br><p style=\"color:red\">La actualización no se ha podido realizar: </p><br>" . $conn->error);
        }
        // Cerrar sentencia
        $stmt->close();

        // cerrar conexion
        $conn->close();
    }

} else {
// Ejecutar select
    $conn = connect();
    $sql = "SELECT usuario, email, password FROM usuarios WHERE idusuario=?";

// Vincular variables a una instrucción preparada como parámetros
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('d', $id);
    $stmt->execute();
    $stmt->bind_result($usuario, $email, $password);
    $stmt->fetch();
    // Cerrar sentencia
    $stmt->close();

    // Cerrar conexión DB
    $conn->close();

}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Perfil</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <!--[if lte IE 8]>
    <script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="assets/css/main.css"/>
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="assets/css/ie8.css"/><![endif]-->
</head>
<body>
<div id="page-wrapper">

    <!-- Header -->
    <?draw_header()?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h2 class="titleSection">Perfil</h2>
        <label class="formText">Usuario:</label> <input type="text" name="user" value="<?=$usuario?>" placeholder=""><br>
        <label class="formText">Correo electrónico:</label> <input type="text" name="email" value="<?=$email?>"><br>
        <label class="formText">Contraseña:</label> <input type="password" name="password" value=""><br>
        <label class="formText">Verifica contraseña:</label> <input type="password" name="repassword" value=""><br>

        <br>
        <div align="center">
            <input type="submit" name="submit" value="Actualizar">
            <input type="button" name="delete" value="Borrar usuario" style="background: red" onclick="deleteUser()">
        </div>

    </form>

    <script>
        function deleteUser() {
            if (confirm("¿Seguro que quieres eliminar el usaurio?")) {
                document.location = './delete.php';
            }
        }

    </script>
</body>



