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
	$sql= "SELECT ac.ID, ac.NOMBRE, it.NOMBRE_ACTI, ac.LUGAR, ac.ALOJAMIENTO, ac.COMIDAS, ac.PRECIO, ac.FECHA_IN, ac.FECHA_FIN  FROM  actividad ac inner join tipos_actidades it on it.ID=ac.TIPO_ACTIVIDAD where 1 ";
if($tipo>0){
$sql .= " and it.ID='$tipo'";
$enlace .="&tipo=$tipo";
}
if(isset($fechafin)){
$sql .= " and ac.FECHA_FIN ='$fechafin'";
$enlace .="&fechafin=$fechafin";

}
if(isset($fechain)){
$sql .= " and ac.FECHA_IN = '$fechain'";
$enlace .="&fechain=$fechain";

}
	$bd=mysqli_connect("localhost","id20911504_admin","#Alfanmc02","id20911504_turismo");
$texto="<h1>Todas las actividades encontradas coincidentes con los filtros</h1><table border='1'><tr><td>Nombre</td> <td>Tipo</td> <td>Lugar</td><td>Alojamiento(si/no)</td><td>Comidas(si/no)</td><td>Precio por persona</td><td>Fecha inicio</td><td>Fecha finalización</td></tr>";
$res=mysqli_query($bd,$sql);
while($fila=mysqli_fetch_assoc($res)){
extract($fila);
$texto.="<tr><td>$NOMBRE</td><td>$NOMBRE_ACTI</td><td>$LUGAR</td><td>$ALOJAMIENTO</td><td>$COMIDAS</td><td>$PRECIO</td><td>$FECHA_IN</td><td>$FECHA_FIN</td></tr>";

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