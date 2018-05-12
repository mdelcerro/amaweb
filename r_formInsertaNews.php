<?php
session_start();
include "includes/conexion.php";
if (isset($_SESSION['user'])){
    $v_usuario = $_SESSION['user'];
}


$sql="SELECT idusuario from usuarios where usuario='$v_usuario'";
$exe=mysqli_query($conexion, $sql);
$res=mysqli_fetch_array($exe);
$id= $res[0];

//recojo datos
$v_titulo = $_POST["titulo"];// Post del input name
//$v_usuario = $_POST["usuario"];
$v_enlace = $_POST["enlace"];
$v_fecha = date("Y/m/d");


//primero hay que comprobar si existe ya
$sql_select = "select titulo from rss where titulo='$v_titulo'";
$eje_select = mysqli_query($conexion, $sql_select) or die("no puede realizar la selección");
$contador = mysqli_num_rows($eje_select);






if (empty($v_titulo) )//Esta comprobación no sería necesaria al poner required en el formulario
{echo "Error. Debe rellenar todos los campos";}

if ($contador==0){
    $sql_alta = "insert into rss (titulo, fecha, idusuario, enlace) values ('$v_titulo', '$v_fecha', '$id', '$v_enlace')";

    $ejecuto_alta = mysqli_query($conexion, $sql_alta);//hago el insert porque no hay registro igual.

}



?>

<table style="width:800px" >
    <th>TITULO</th>
    <th>USUARIO</th>
    <th>ENLACE</th>
    <th>FECHA</th>


    <tr>

        <td><?php echo $v_titulo;?></td>
        <td><?php echo $v_usuario;?></td>
        <td><?php echo $v_enlace;?></td>
        <td><?php echo $v_fecha;?></td>

    </tr>
</table>
<br /><br />
<a href="index.php">Volver al inicio</a>
<br /><br />
<a href="formInsertaNews.php">Inserta otra noticia</a>

