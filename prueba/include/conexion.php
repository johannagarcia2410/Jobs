<?php
$servidor="localhost";
$usuario="root";
$password="";
$bd="consware";


$_SESSION['sBdServidor']=$servidor;
$_SESSION['sBdUsuario']=$usuario;
$_SESSION['sBdPassword']=$password;
$_SESSION['sBdNombreBd']=$bd;


$mysqli = mysqli_connect($servidor,$usuario,$password,$bd);
mysqli_set_charset($mysqli, "utf8");
if (mysqli_connect_errno())
{
	echo "Fallo para conectar a MySQL: " . mysqli_connect_error();
	exit();
}


?>