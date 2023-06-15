<?php 
session_start();
?>
<html>
<head>
    <link rel="icon" type="image/x-icon" href="icono2.png">
<title>creacion</title>
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
$bd=mysqli_connect("localhost","id20911504_admin","#Alfanmc02","id20911504_turismo");
echo "
<h1> Creación nueva actividad </h1>
<div class='container formulario'>
<form action='creaactip.php' method='POST'>
  <div class='mb-3'>
  <label for='nombreacti' class='form-label'>nombre de la actividad</label>
    <input type='text' class='form-control' id='nombreacti'   name='nombre'>
  </div>
   <div class='mb-3'>
  <label for='lugar' class='form-label'>nombre del lugar</label>
    <input type='text' class='form-control' id='lugar'  name='lugar'>
  </div>
  <div class='mb-3'>
  <label for='precio' class='form-label'>precio por persona</label>
    <input type='number' class='form-control' id='precio'  name='precio'>
  </div>
   <div class='mb-3'>
  <label for='fechain' class='form-label'>fecha de inicio</label>
    <input type='date' class='form-control' id='fechain'   name='fechain'>
  </div>
     <div class='mb-3'>
  <label for='fechafin' class='form-label'>fecha de finalización</label>
    <input type='date' class='form-control' id='fechafin'   name='fechafin'>
  </div>
  <div class='mb-3'>
   <label for='alojamiento' class='form-label'> ¿tiene alojamiento?</label>
  <select name='alojamiento' id='alojamiento'>
 
		<option value='no' selected>no</option>
		<option value='si'>si</option>
</select></div>
 <div class='mb-3'> <label for='comidas' class='form-label'> ¿tiene comidas?</label><select name='comidas' id='comidas'>

	<option value='no' selected>no</option>
		<option value='si'>si</option>
		
</select></div> <div class='mb-3'>  <label for='tipo' class='form-label'> tipo de la actividad</label> <select name='tipo' id='tipo'>";
  $res=mysqli_query($bd,"SELECT * FROM `tipos_actidades`");
while($filas=mysqli_fetch_array($res)){
	echo"<option value='$filas[0]'>$filas[1]</option>";

}
  echo "
  </select></div>
  <button type='submit' class='btn btn-primary'>Enviar</button>
</form>
</div>
";


?>
</footer>
<script src="comprolog.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>