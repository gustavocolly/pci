<?php
session_start(); // Starting Session
$error=''; // Variable to Store Error Messages
if (isset($_POST['submit'])) 
{
	if (empty($_POST['usuario']) || empty($_POST['password'])) 
	{
	$error = "El Usuario o Password es inválido";
	}
	else
	{
	// Define $username and $password
	$usuario=$_POST['usuario'];
	$password=$_POST['password'];
	// To protect MySQL injection for Security purpose
	$usuario = stripslashes($usuario);
	$password = stripslashes($password);
	// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	$con_mysql = mysqli_connect("localhost", $usuario, $password, "pci_db");
	if (mysqli_connect_errno($con_mysql)) 
		{
		$error = "Error al conectar a MySQL: " . mysqli_connect_error();
		}
	else
		{
		$_SESSION['usuario']=$usuario; // Initializing Session
		$_SESSION['password']=$password;
		$_SESSION['session']= True;
		header("location: main.php"); // Redirecting To Other Page	
		}
	mysqli_close($con_mysql); // Closing Connection
	}	
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login Form - PCI (Programa de Control de Inversiones)</title>
<meta name="description" content="Programa de Control de Inversiones">
<meta name="author" content="Gustavo Colly">
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
<!-- Comienzo del header -->
<div id="main">
<!-- Comienzo del Logo -->
	<div id="logo">
		<img alt="pci.guscol.com.ar" src="/images/money_medium.png"></img>
	</div>
	<div id="title">
		<h1>Página de Inicio de Sesión</h1>		
	</div>
	<div id="login_form">
		<form action="index.php" method="post">
			<label>Usuario:</label>
			<input id="usuario" name="usuario" placeholder="usuario" type="text">
			<label>Password :</label>
			<input id="password" name="password" placeholder="**********" type="password">
			<input name="submit" type="submit" value=" Login ">
		</form>
	</div>
</div>
<!-- Comienzo de Area de Errores -->
<div id="error_area">
	<p><?php echo $error; ?></p>
</div>
<!-- Fin de Area de Errores -->
<!-- Comienzo del pie de página -->
<div id="footer">
<p>Copyright &#169; Gustavo Colly - C&#243;digo Version #0.1 - 6 Abr 2017</p>
</div>
<!-- Fin del pie de página -->
</body>
</html>