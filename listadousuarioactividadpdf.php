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
$texto="<h1>Actividades inscritas por el usuario seleccionado</h1><table border='1'><tr><td>Nombre</td> <td>Tipo</td> <td>Lugar</td><td>Alojamiento(si/no)</td><td>Comidas(si/no)</td><td>Precio Total</td><td>Nº Personas</td><td>Fecha inicio</td><td>Fecha finalización</td></tr>";
$res=mysqli_query($bd,"SELECT * FROM usuario inner join actividad_usuario on usuario.DNI=actividad_usuario.DNI inner join actividad on actividad.id=actividad_usuario.id inner join tipos_actidades on tipos_actidades.id=actividad.tipo_actividad where usuario.DNI='$usuario' order by usuario.DNI");
while($fila=mysqli_fetch_assoc($res)){
extract($fila);
$texto.= "<tr><td>$NOMBRE</td><td>$NOMBRE_ACTI</td><td>$LUGAR</td><td>$ALOJAMIENTO</td><td>$COMIDAS</td><td>$preciototal</td><td>$personas</td><td>$FECHA_IN</td><td>$FECHA_FIN</td></tr>";
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