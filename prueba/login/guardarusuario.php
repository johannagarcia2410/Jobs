<?php 
 
    require('conexion.php');
    
	$usuario=$_POST['usuario'];
	$password=$_POST['password'];
	
	$hash = md5($password);
	$hash2 = sha1($hash);

	$query="INSERT INTO usuario (codigo, password) VALUES ('$usuario','$hash2')";
	
	$resultado=$mysqli->query($query);
	
	
?>