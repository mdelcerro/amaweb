




<?php


include 'functions.php';

//Llamamos a la función session-start para iniciar una nueva sesión
session_start();

$error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $pwd = null;

    if (empty($_POST['user']) || empty($_POST['password'])) {
        $error = true;
    } else {

        $conn = connect();
        $sql = "SELECT password FROM usuarios WHERE usuario = ?";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param('s', $_POST['user']);
        $stmt->execute();
        $stmt->bind_result($pwd);
        if (!$stmt->fetch() || $pwd != $_POST['password']) {
            $error = true;
        }
        $stmt->close();
        $conn->close();
    }
    if (!$error) {
        $_SESSION["user"] = $_POST['user'];
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
                                    <li class="inactive"><a href="registro.php">Registro</a></li>
                                    <li class="current"><a href="acceso.php">Inicia sesión</a></li>
                                </ul>
                            </nav>

                    </header>
                </div>

<?php
if (!is_logged()) { // comprobamos que las variables de sesión estén vacías
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label class="formText">Usuario:</label><br/>
        <input  type="text" name="user"/><br/>
        <label class="formText">Contraseña:</label><br/>
        <input type="password" name="password"/><br/>
         <div align="center">
        <input type="submit" name="enviar" value="Login"/>
    </div>
        <?php if ($error) {
            echo "<div style=\"text-align:center\"><br><b style=\"color:red\">Error en el login</b><br /></div>";
        } ?>
    </form>
    <?php
} else {
    ?>
    <p>Hola <strong><?= $_SESSION['user'] ?></strong> | <a href="logout.php">Cerrar sesión</a></p>
    <?php
}

?>

