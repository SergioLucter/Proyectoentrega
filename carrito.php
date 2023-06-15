<?php 
session_start();
?>

<html>
<head>
    <link rel="icon" type="image/x-icon" href="icono2.png">
<title>carrito</title>
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
extract($_GET);
extract($_POST);
if(isset($eliminar)){
unset($_SESSION["carrito"][$id]);
}
elseif(isset($nada)){
$venidodellogin=1;
}
else{
$_SESSION["carrito"][$id]["precio"]=$precio*$persona;
$_SESSION["carrito"][$id]["personas"]=$persona ;
}
if(isset($_SESSION["carrito"])){
    if(count($_SESSION["carrito"])>0){
echo "<h1>Su carrito</h1><div class='container informacion'>
<table class='table table-bordered'>
<tr><td>Nombre</td> <td>Tipo</td> <td>Lugar</td><td>Alojamiento(si/no)</td><td>Comidas(si/no)</td><td>Precio total</td><td>Numero de personas</td><td>Fecha inicio</td><td>Fecha finalización</td></tr>";
foreach ($_SESSION["carrito"] as $indice1=> $valor1){
$bd=mysqli_connect("localhost","id20911504_admin","#Alfanmc02","id20911504_turismo");
$sql= "SELECT ac.ID, ac.NOMBRE, ac.PRECIO, it.NOMBRE_ACTI, ac.LUGAR, ac.ALOJAMIENTO, ac.COMIDAS, ac.FECHA_IN, ac.FECHA_FIN  FROM  actividad ac inner join tipos_actidades it on it.ID=ac.TIPO_ACTIVIDAD where ac.ID=$indice1 ";
$ins=mysqli_query($bd,$sql);
while($fila=mysqli_fetch_assoc($ins)){
extract($fila);
echo "<tr><td>$NOMBRE</td><td>$NOMBRE_ACTI</td><td>$LUGAR</td><td>$ALOJAMIENTO</td><td>$COMIDAS</td><td>".$valor1["precio"]."</td><td><form method='post' action='carrito.php?id=$ID&persona=".$valor1["personas"]."&precio=$PRECIO&modificar=1'><td><input type='number' value='".$valor1["personas"]."' min='1' name='persona' ></td></td><td>$FECHA_IN</td><td>$FECHA_FIN</td><td><button class='btn btn-primary' type='submit'>Cambiar informacion del carrito</button></td><td></form><form method='post' action='carrito.php?id=$ID&eliminar=1'><button class='btn btn-primary'>eliminarlo del carrito</button></td></form></tr>"; 
}
}echo "</table><form action='completarcompra.php'>
<button type='submit' class='btn btn-primary'> completar compra</button>

</form></div>";}else{
echo "<H2>El carrito se encuentra vacío</H2>";
}}
else{
echo "<H2>El carrito se encuentra vacío</H2>";
}
?>
<script src="comprolog.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>