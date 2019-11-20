<?php
	//Devuelve el nombre del grupo dado su codigo
	function obtenerNombreGrupo($idGrupo)
	{
		include("conexion.php");
		$nombre="";
		$consulta="
			SELECT nombre
			FROM grupo
			WHERE id=$idGrupo
			
		";
		$resultado = @mysqli_query($mysqli,$consulta); 
		
		
		$numReg = mysqli_affected_rows($mysqli);
		
		if($numReg>0)
		{
			$fila=mysqli_fetch_array($resultado);
			$nombre=$fila['nombre'];
			
		}
		mysqli_close($mysqli);
		return $nombre;		  
    }       
	
	
	
	
	
	

?>