<?php session_start();
header("Content-type:application/pdf");?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>Pedidos</title>		
	</head>
	<body>
	<?php 
	extract($_GET);
	$bd=mysqli_connect("localhost","id20911504_admin","#Alfanmc02","id20911504_turismo");
$texto="<h1>Usuarios inscritos en la actividad seleccionada</h1><table border='1'><tr><td>Nombre</td> <td>correo</td> <td>telefono</td></tr>";
$res=mysqli_query($bd,"SELECT 	* FROM usuario inner join actividad_usuario on usuario.DNI=actividad_usuario.DNI  where actividad_usuario.ID='$id'");
while($fila=mysqli_fetch_assoc($res)){
extract($fila);
$texto.= "<tr><td>$NOMBRE_APELLIDOS</td><td>$CORREO</td><td>$TELEFONO</td></tr>";
}
$texto.="</table>";
	include_once "./vendor/autoload.php";
	use Dompdf\Dompdf;
	$dompdf = new Dompdf();
	$html=$texto;
	$dompdf->loadHtml($html);
	$dompdf->render();
	echo $dompdf->output();
	?>		
	</body>
</html>