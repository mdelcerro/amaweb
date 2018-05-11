<?php

include 'functions.php';
include 'sendmail.php';

//Llamamos a la función session-start para iniciar una nueva sesión
session_start();

?>
<?php

$user = $email = $password = $repassword = "";
$userError = $emailError = $passwordError = $repasswordError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $error = false;

    if (empty($_POST["user"])) {
        $userError = "<div style=\"text-align:center\"><br><b style=\"color:red\">Introduce un usuario.</b><br /></div>";
        echo $userError;
        $error = true;
    } else {
        $user = trim($_POST["user"]);
    }

    if (empty($_POST["email"])) {
        $emailError = "<div style=\"text-align:center\"><br><b style=\"color:red\">Introduce una dirección de correo electrónico.</b><br /></div>";
        echo $emailError;
        $error = true;
    } else {
        $email = trim($_POST["email"]);
    }

    if (empty($_POST["password"])) {
        $passwordError = "<div style=\"text-align:center\"><br><b style=\"color:red\">Introduce una contraseña.</b><br /></div>";
        echo $passwordError;
        $error = true;
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty($_POST["repassword"]) || ($_POST["password"]!=$_POST["repassword"])) {

        $repasswordError = "<div style=\"text-align:center\"><br><b style=\"color:red\">Verifica la contraseña.</b><br /></div>";
        echo $repasswordError;
        $error = true;
    } else {
        $repassword = trim($_POST["repassword"]);
    }

    if (!$error) {

        $conn = connect();

        // Ejecutar insert
        $sql = "INSERT INTO `usuarios`(`usuario`, `email`, `password`) VALUES (?, ?, ?)";

        // Vincular variables a una instrucción preparada como parámetros
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $user, $email, $password);

        if ($stmt->execute() === FALSE) {
            die("<br><p style=\"color:red\">La inserción no se ha podido realizar: </p><br>" . $conn->error);
        }
        // Cerrar sentencia
        $stmt->close();

        // Cerrar conexión
        $conn->close();

        $body = "Hola $user<br><br>
        ¡Bienvenido/a a Amaweb!<br><br>
        Tu cuenta te da acceso a añadir y consultar todos los artículos que te interesan en cualquier momento, lugar y dispositivo.<br><br>
        ¡Feliz RSS!<br><br>
        El equipo de Amaweb";


        sendEmail($email, "Te has registrado en Amaweb", $body);

        header('Location: index.php');
        die();

    }
}

?>
<!DOCTYPE html>
<html>
<head>
   <title>Registro</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="assets/css/main.css" />
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
</head>
<body>
    <div id="page-wrapper">

        <?draw_header()?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h2 class="titleSection">REGISTRO</h2>
    <label class="formText">Usuario:</label> <input  type="text" name="user" value="" placeholder=""><br>
    <label class="formText">Correo electrónico:</label> <input  type="text" name="email" value=""><br>
    <label class="formText">Contraseña:</label> <input  type="password" name="password" value=""><br>
    <label class="formText">Verifica contraseña:</label> <input  type="password" name="repassword" value=""><br>

    <br>
    <div align="center">
    <input  type="submit" name="submit" value="Registrar">
    </div>

</form>
</body>




