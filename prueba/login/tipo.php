<?php

	include('conexion.php');

	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
	
	$usu=$_SESSION['usuario'];
	$query="SELECT *
 FROM usuario where codigo = $usu ";
	$resultado = @mysqli_query($mysqli,$query); 
	
	
	$row=$resultado->fetch_assoc();
	
	$tipo=$row["idTipoUsuario"];

	mysqli_close($mysqli);
	
	
		
?>