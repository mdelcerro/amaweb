<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Registro y login</title>
</head>

<body>
	<form action="" method="post">
		<label>Nombre de usuario: </label><input type="text" name="userreg"><br /><br />
		<label>Contraseña: </label><input type="password" name="pwreg"><br /><br />
		<label>Repite la contraseña: </label><input type="password" name="pwregveri"><br /><br />
		<input type="submit" name="registrar" value="Registrarme">
	</form>
	<?php
		include "includes/conexion.php";
		if(isset($_POST['registrar']))
		{
			if($_POST['userreg'] == '' or $_POST['pwreg'] == '')
			{echo "Debe completar todos los campos.";
			}else{
				
				$sql= 'SELECT * FROM usuarios';
				$sql_eje = mysqli_query($conexion, $sql);
				$comprueba=0;
				
				while($resultado = mysqli_fetch_object($sql_eje))
				{
					if($resultado->nombreusuario == $_POST['userreg'])
					{
						$comprueba = 1;
					}
				}
				if($comprueba == 0)
				{
					if($_POST['pwreg'] == $_POST['pwregveri'])
					{
						$nom = $_POST['userreg'];
						$pw = $_POST['pwreg'];
						$pw_encryp = password_hash($pw, PASSWORD_DEFAULT);

						$conexion->query("INSERT INTO usuarios (nom_usuario, password) VALUES ('$nom','$pw_encryp')");
						mysqli_query($conexion,$sql);

						echo "Te has registrado correctamente.";
					}else{
						echo "Las contraseñas introducidas no coinciden.";
					}
				}else{
					echo "El nombre introducido ya está en la base de datos, prueba con otro.";
				}
			}
		}
	?>
</body>
</html>