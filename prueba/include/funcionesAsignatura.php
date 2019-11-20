<?php
	//Devuelve el nombre de la asignatura pasandole el codigo de asignatura
	function obtenerNombreAsignatura($idAsignatura)
	{
		include("conexion.php");
		$consulta="
			SELECT nombre 
			FROM asignatura
			WHERE codigo=$idAsignatura			
		";
		$resultado = @mysqli_query($mysqli,$consulta); 
		$indice=0; 
		
		if (mysqli_affected_rows($mysqli)>0)
		{
			$fila=mysqli_fetch_array($resultado);
			$nombre=$fila['nombre'];	
		}
		else
		{
			$nombre="";
		}
		
		
		mysqli_close($mysqli);
		return $nombre;		  
    }       

?>