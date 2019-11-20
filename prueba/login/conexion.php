<?php
	$servidor=@$_SESSION['sBdServidor'];
	$usuario=@$_SESSION['sBdUsuario'];
	$password=@$_SESSION['sBdPassword'];
	$bd=@$_SESSION['sBdNombreBd'];
	
	
	$servidor="localhost";
	$usuario="root";
	$password="";
	$bd="consware";
	
	
	$mysqli = mysqli_connect($servidor,$usuario,$password,$bd);
	if (mysqli_connect_errno())
	{
		echo "Fallo para conectar a MySQL: " . mysqli_connect_error();
		exit();
	}


?>