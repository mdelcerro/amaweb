<?php
include 'utils.php';

//Llamamos a la función session-start para iniciar una nueva sesión
session_start();

$error = false;
if($_SERVER["REQUEST_METHOD"] == "POST") {

    $pwd = null;

    if (empty($_POST['dni']) || empty($_POST['password'])) {
        $error = true;
    } else {

        $conn = connect();
        $sql = "SELECT Password FROM Usuarios WHERE DNI = ?";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param('s', $_POST['dni']);
        $stmt->execute();
        $stmt->bind_result($pwd);
        if (!$stmt->fetch() || $pwd != $_POST['password']) {
            $error = true;
        }
        $stmt->close();
        $conn->close();
    }

    if (!$error) {
        $_SESSION["dni"] = $_POST['dni'];
        header('Location: index.html');
        die();
    }
}


if (!is_logged()) { // comprobamos que las variables de sesión estén vacías
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label>Usuario:</label><br/>
        <input type="text" name="dni"/><br/>
        <label>Contraseña:</label><br/>
        <input type="password" name="password"/><br/>
        <input type="submit" name="enviar" value="Login"/>
        <?php if ($error) {
            echo "bad boy";
        }?>
    </form>
    <?php
} else {
    ?>
    <p>Hola <strong><?= $_SESSION['dni'] ?></strong> | <a href="logout.php">Cerrar sesión</a></p>
    <?php
}

?>

