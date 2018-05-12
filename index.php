<?php
include "functions.php";
include "includes/conexion.php";
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Amaweb</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body class="homepage">
		<div id="page-wrapper">

			<!-- Header -->
            <?php draw_header();?>

			<!-- Banner -->
				<div id="banner-wrapper">
					<div id="banner" class="box container">
						<div class="row">
							<div class="7u 12u(medium)">
								<h2>Hola. Bienvenido a Amaweb.</h2>
								<p>La aplicación para concentrar todos los artículos que te interesan.</p>
							</div>
							
					
				
				<div>
				    <?php 
				      $sql="SELECT titulo, enlace, usuario, fecha from usuarios inner join rss on usuarios.idusuario=rss.idusuario order by rss.fecha DESC";
                      $exe=mysqli_query($conexion, $sql) or die ("No se puede realizar la conexion");
                      ?>
                        
                        <table id='tabla' width="800" border="2">
                            <caption>NOTICIAS PUBLICADAS</caption><br /><br />
                           
                        <th>Titulo</th><th>Enlace</th><th>Usuario</th><th>Fecha publicación</th>
                     <?php      
	                	while($rgto = mysqli_fetch_row($exe))
	                	{
	            		?>
                   <tr>
                	<td><?php echo $rgto[0];?></td>
                	<td><?php echo $rgto[1];?></td>
                   <td><?php echo $rgto[2];?></td>
                    <td><?php echo $rgto[3];?></td>
                    </tr>
				   <?php } ?>
				</div>
				
				
				<div class="5u 12u(medium)">
								<ul>
									<li><a href="registro.php" class="button big icon fa-arrow-circle-right">Ok, registrarme</a></li>
									<li><a href="#" class="button alt big icon fa-question-circle">Más info</a></li>
								</ul>
							</div>
					
            </div>
         </div>
    	</div>
			<!-- Footer -->
				<div id="footer-wrapper">
					<footer id="footer" class="container">
								<!-- Contacto -->
									<section class="widget contact last">
										<h3>Síguenos en redes</h3>
										<ul>
											<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
											<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
											<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
											
										</ul>
									</section>

							</div>
						</div>
						<div class="row">
							<div class="12u">
								<div id="copyright">
									<ul class="menu">
										<li>&copy; Grupo Amaweb. Todos los derechos reservados.</li>
									</ul>
								</div>
							</div>
						</div>
					</footer>
				</div>

			</div>

		<!-- Scripts -->

			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>
