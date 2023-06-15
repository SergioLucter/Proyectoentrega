<?php 
session_start();
?>
<html>
<head>
    <link rel="icon" type="image/x-icon" href="icono2.png">
<title>Usuarios</title>
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
<h1>Seleccione el usuario que desea buscar</h1>
<div class='container formulario'>
<form method="post" name="formusu" action="listadousuarioactividad.php">
<select name="usuario">
<option value="0">Seleccione un usuario</option>
<?php 
$bd=mysqli_connect("localhost","id20911504_admin","#Alfanmc02","id20911504_turismo");
$ins=mysqli_query($bd,"SELECT * from usuario where DNI!='11111111A'");
while($fila=mysqli_fetch_assoc($ins)){
extract($fila);
echo "<option value='$DNI'>$NOMBRE_APELLIDOS</option>";
}
?>
</select>
<p></p>
<input type="submit"></input>
</form>
</div>
<script src="comproblog.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>