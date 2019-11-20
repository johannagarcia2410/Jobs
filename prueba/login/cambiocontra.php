<?php
    require('conexion.php');
	session_start();
$cod = $_SESSION['usuario'];
    
	$oldcontra=$_POST['oldcontra'];
	$newcontra=$_POST['newcontra'];
	$newcontra2=$_POST['newcontra2'];
	
	//se encripta la vieja password
	$oldcontra1 = md5($oldcontra);
	$oldcontra2 = sha1($oldcontra1);
	
	// se encripta la nueva password 
	$hash = md5($newcontra);
	$hash2 = sha1($hash);
	
	

	
	
$query1="SELECT *
 FROM usuario where codigo = $cod ";
	
	$resultado1=$mysqli->query($query1);
	$row1=$resultado1->fetch_assoc();
	
	$contra=$row1["password"];
	
	if($contra == $oldcontra2){
	if($newcontra == $newcontra2){

	$query="UPDATE usuario SET password = '$hash2' where codigo = '$cod'";
	
	$resultado=$mysqli->query($query);

	 header("location:index.php");
	 }else{
	 echo "Las nuevas passwords introducidas no coinciden " ;
echo "<a href='nuevacontra.php'>Regresar</a>";
	 }
	 }else{
echo "Tu antigua password es incorrecta vuelva a intentarlo " ;
echo "<a href='nuevacontra.php'>Regresar</a>";
	 }
	 
	?>
