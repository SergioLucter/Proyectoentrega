<?php 
session_start();
$bd=mysqli_connect("localhost","id20911504_admin","#Alfanmc02","id20911504_turismo");
$hoy = date("Y-m-d");
$busqueda= "SELECT ID from actividad where FECHA_IN <'$hoy'";
$resulta=mysqli_query($bd,$busqueda);
while($row=mysqli_fetch_assoc($resulta)){
extract($row);
$eliminacion="delete from actividad_usuario where ID=$ID";
$resultad=mysqli_query($bd,$eliminacion);
if($resultad){
$eliminacion1="delete from actividad where ID=$ID";
$resultado=mysqli_query($bd,$eliminacion1);
if($resultado){
$correcto="ok";


}

}

}
?>
<html>
<head>
    <link rel="icon" type="image/x-icon" href="icono2.png">
<title>actividades</title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="xd.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body class="fondo">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand achicar" href="inicio.php"><img src="mundo.png" class="icono"></a>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active navar" aria-current="page" href="inicio.php"><h5>Turismos Recio</h5></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="selectoractividades.php">Ver actividades</a>
        </li>
      </ul>
	  <?php
	  
	  if(isset($_SESSION["usuario"]["correo"])){
	  if($_SESSION["usuario"]["correo"]!="admin@gmail.com"){
	  echo '<ul class="navbar-nav si">
	  <li class="nav-item">
          <a class="nav-link" href="misdatos.php">Mis datos</a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="misactividades.php">mis actividades</a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="carrito.php?nada=1">mi carrito</a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="inicio.php?salir=yas">logout</a>
        </li>
	  </ul>';}
	  else{
	  echo '<ul class="navbar-nav si">
	  <li class="nav-item">
          <a class="nav-link" href="misdatos.php">Mis datos</a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="listadousuarios.php">usuarios</a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="listadoacti.php">lista actividades</a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="selectusuarios.php">listados de usuarios inscritos</a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="inicio.php?salir=yas">logout</a>
        </li>
	  </ul>';}
	  }
	  else{
     echo '<ul class="navbar-nav si">
	  <li class="nav-item">
          <a class="nav-link" href="login.html">Log in</a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="signup.html">Registrarse</a>
        </li>
	  </ul>';}
	  ?>
    </div>
  </div>
</nav>
<?php
extract($_POST);
$bd=mysqli_connect("localhost","id20911504_admin","#Alfanmc02","id20911504_turismo");
$enlace="actividadespdf.php?h=h";
$sql= "SELECT ac.ID, ac.NOMBRE, it.NOMBRE_ACTI, ac.LUGAR, ac.ALOJAMIENTO, ac.COMIDAS, ac.PRECIO, ac.FECHA_IN, ac.FECHA_FIN  FROM  actividad ac inner join tipos_actidades it on it.ID=ac.TIPO_ACTIVIDAD where 1 ";
if($tipo>0){
$sql .= " and it.ID='$tipo'";
}
$enlace .="&tipo=$tipo";
if(isset($fechafinsi)){
$sql .= " and ac.FECHA_FIN ='$fechafin'";
$enlace .="&fechafin=$fechafin";

}
if(isset($fechainsi)){
$sql .= " and ac.FECHA_IN = '$fechain'";
$enlace .="&fechain=$fechain";

}
$ins=mysqli_query($bd,$sql);
if(mysqli_num_rows($ins)>0){
echo "<h1>Listado de actividades</h1><div class='container informacion'><table class='table table-bordered'> <tr><td>Nombre</td> <td>Tipo</td> <td>Lugar</td><td>Alojamiento(si/no)</td><td>Comidas(si/no)</td><td>Precio por persona</td><td>Fecha inicio</td><td>Fecha finalización</td><td>";
if(isset($_SESSION["usuario"]["correo"])){
 if($_SESSION["usuario"]["correo"]!="admin@gmail.com"){
 echo "inserte el numero de personas";
 
 }
 }

echo"</td></tr>";
while($fila=mysqli_fetch_assoc($ins)){
extract($fila);
echo "<tr><td>$NOMBRE</td><td>$NOMBRE_ACTI</td><td>$LUGAR</td><td>$ALOJAMIENTO</td><td>$COMIDAS</td><td>$PRECIO</td><td>$FECHA_IN</td><td>$FECHA_FIN</td>"; 
 if(isset($_SESSION["usuario"]["correo"])){
 if($_SESSION["usuario"]["correo"]!="admin@gmail.com"){
 $user=$_SESSION["usuario"]["correo"];
 $sql3= "select actividad.ID from usuario inner join actividad_usuario on usuario.DNI= actividad_usuario.DNI inner join actividad on actividad.ID= actividad_usuario.ID where usuario.CORREO='$user' AND actividad.ID='$ID'";
 $res2=mysqli_query($bd,$sql3);
 $sql2= "select actividad.ID from usuario inner join actividad_usuario on usuario.DNI= actividad_usuario.DNI inner join actividad on actividad.ID= actividad_usuario.ID where usuario.CORREO='$user' AND actividad.ID!='$ID' and 
 ((actividad.FECHA_IN >= '$FECHA_IN' AND actividad.FECHA_FIN <= '$FECHA_IN') or (actividad.FECHA_IN <= '$FECHA_FIN' AND actividad.FECHA_FIN >= '$FECHA_FIN')) ";
 $res=mysqli_query($bd,$sql2);
 if(mysqli_num_rows($res)>0){
 echo "<form method='post' action='inscribirse.php?id=$ID'><td> <input type='number' value='1' min='1' disabled name='persona'></td>";
 echo"<td><button class='btn btn-primary' type='submit' disabled>se pisa con actividad inscrita</button>";
 
 }
  elseif(mysqli_num_rows($res2)>0){
 echo "<form method='post' action='inscribirse.php?id=$ID'><td><input type='number' value='1' min='1' name='persona' disabled></td>";
 echo"<td><button class='btn btn-primary' type='submit' disabled>Ya se encuentra inscrito en esta actividad</button>";
 }
 elseif(isset($_SESSION["carrito"][$ID])){
	echo "<form method='post' action='carrito.php?id=$ID&precio=$PRECIO&modificar=1'><td><input type='number' value='1' min='1' name='persona' ></td>";
 echo"<td><button type='submit' class='btn btn-primary'>Cambiar informacion del carrito</button></td></form><td><form method='post' action='carrito.php?id=$ID&eliminar=1'><button class='btn btn-primary'>eliminarlo del carrito</button>";
 
 }
  else{
	echo "<form method='post' action='carrito.php?id=$ID&precio=$PRECIO'><td><input type='number' value='1' min='1' name='persona'></td>";
 echo"<td><button class='btn btn-primary' type='submit'>añadir al carrito</button>";}
 }
else{
 echo"<form method='post' action='inscribirse.php?id=$ID'><td><button type='submit' class='btn btn-primary' disabled>admins no</button>";
} 
 }
 else{
 echo"<form method='post' action='inscribirse.php?id=$ID'><td><button type='submit'class='btn btn-primary' disabled>debe logearse primero</button>";
} 
echo"</td></form></tr>";
}
    echo " </table> <a href='$enlace'><button type='button' class='btn btn-primary'>ver en pdf</button></a></div>";
    
}
else{
    
    echo "<h2>No se han encontrado actividades</h2>";
}
?>
</table>
<footer>
</footer>
<script src="comprolog.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>