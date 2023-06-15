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
<title>mis actividades</title>
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
$ins=mysqli_query($bd,"SELECT 	usuario.DNI,actividad.ID,actividad.LUGAR, actividad.NOMBRE,actividad.FECHA_IN,actividad.FECHA_FIN ,actividad_usuario.preciototal, actividad_usuario.personas ,actividad.COMIDAS ,actividad.PRECIO, actividad.ALOJAMIENTO,tipos_actidades.NOMBRE_ACTI   FROM usuario inner join actividad_usuario on usuario.DNI=actividad_usuario.DNI inner join actividad on actividad.id=actividad_usuario.id inner join tipos_actidades on tipos_actidades.id=actividad.tipo_actividad where usuario.correo='".$_SESSION["usuario"]["correo"]."' order by usuario.DNI");
if(mysqli_num_rows($ins)>0){
    echo "<h1>Actividades en las que usted se encuentra inscrito</h1><div class='container informacion'>
<table class='table table-bordered'>
<tr><td>Nombre</td> <td>Tipo</td> <td>Lugar</td><td>Alojamiento(si/no)</td><td>Comidas(si/no)</td><td>Precio total</td><td>numero de personas</td><td>Fecha inicio</td><td>Fecha finalización</td></tr>";
while($fila=mysqli_fetch_assoc($ins)){
extract($fila);
echo "<tr><td>$NOMBRE</td><td>$NOMBRE_ACTI</td><td>$LUGAR</td><td>$ALOJAMIENTO</td><td>$COMIDAS</td><td>$preciototal</td><td>$personas</td><td>$FECHA_IN</td><td>$FECHA_FIN</td><td><a href='eliminarelacion.php?id=$ID&dni=$DNI'><button type='button' class='btn btn-primary'>Cancelar</button></a></td><td><a href='listadogentepdf.php?id=$ID'><button type='button' class='btn btn-primary'>Ver listado de gente en pdf</button></a></td></tr>";
}

    echo " </table> <a href='misactividadespdf.php?dni=$DNI'><button type='button' class='btn btn-primary'>ver listado en pdf</button></a>";
}
else{
    echo "<h2>Usted no se encuentra inscrito en ninguna actividad</h2>";
    
}
?>
</table>
</div>
</footer>
<script src="comprolog.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>