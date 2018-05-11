<?php
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Formulario inserta news Amaweb</title>	
</head>
<body>
	<form action="r_formInsertaNews.php" method="post" id="entra" name="form_inserta" align="center">
		
			Título de la noticia:  <input name="titulo" id="entra" type="text" size="60"  required><br/><br/>

			Enlace:  <input name="enlace" id="entra" type="text" size="100"  required><br/><br/>

        <!--	Usuario:  <input name="user" id="entra" type="text" size="20"  required><br/><br/> -->
           
       <!-- Descripción: <textarea name="descripcion" id="entra" rows="10" cols="70" ></textarea><br/><br/> -->
			
			<input name="enviar" type="submit" value="Añade">
	</form>

	
</body>
</html>

