<?php

include 'functions.php';

//Llamamos a la función session-start para iniciar una nueva sesión
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Actividad 10</title>
</head>
<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

    Usuario: <input type="text" name="user" value=""><br>
    Correo electrónico: <input type="text" name="email" value=""><br>
    Contraseña: <input type="password" name="password" value=""><br>
    <br><input type="submit" name="submit" value="Registrar">

</form>
</body>

<?php

$user = $email = $password = "";
$userError = $emailError = $passwordError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $error = false;

    if (empty($_POST["user"])) {
        $userError = "<br><b style=\"color:red\">Introduce un usuario.</b><br />";
        echo $userError;
        $error = true;
    } else {
        $user = trim($_POST["user"]);
    }

    if (empty($_POST["email"])) {
        $emailError = "<br><b style=\"color:red\">Introduce una dirección de correo electrónico.</b><br />";
        echo $emailError;
        $error = true;
    } else {
        $email = trim($_POST["email"]);
    }

    if (empty($_POST["password"])) {
        $passwordError = "<br><b style=\"color:red\">Introduce una contraseña.</b><br />";
        echo $passwordError;
        $error = true;
    } else {
        $password = trim($_POST["password"]);
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

    }
}

?>


