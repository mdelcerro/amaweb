<?php

include 'functions.php';

//Llamamos a la función session-start para iniciar una nueva sesión
session_start();

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

            <!-- Header -->
                <div id="header-wrapper">
                    <header id="header" class="container">

                        <!-- Logo -->
                        <div id="logo">
                            <a href="index.php" ><img src="images/logo.png" alt="logo" width="100px"></a>
                        </div>


                        <!-- Nav -->
                            <nav id="nav">
                                <ul>
                                    <li class="inactive"><a href="index.php">Cómo funciona</a></li>
                                    <li class="current"><a href="registro.php">Registro</a></li>
                                    <li class="inactive"><a href="acceso.php">Inicia sesión</a></li>
                                </ul>
                            </nav>

                    </header>
                </div>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h2 class="titleSection">REGISTRO</h2>
    <label class="formText">Usuario:</label> <input  type="text" name="user" value="" placeholder=""><br>
    <label class="formText">Correo electrónico:</label> <input  type="text" name="email" value=""><br>
    <label class="formText">Contraseña:</label> <input  type="password" name="password" value=""><br>
    <br>
    <div align="center">
    <input  type="submit" name="submit" value="Registrar">
    </div>

</form>
</body>

<?php

$user = $email = $password = "";
$userError = $emailError = $passwordError = "";

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


