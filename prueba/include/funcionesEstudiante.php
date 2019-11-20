<?php
	//Devuelve un vector con los meses digitados dentro de una vigencia
	function obtenerDatosEstudiante($id,&$noDocumento,&$nombre,&$direccion, &$telefono,&$barrio,&$fechaNacimiento,&$email, &$contacto,&$parentesco,&$telContacto)
	{
		include("conexion.php");
		
		$noDocumento="";
		$nombre="";
		$direccion="";
		$telefono="";
		
		$consulta="
			SELECT noDocumento,upper( concat(papellido , ' ' ,sapellido, ' ' , pnombre , ' ' , snombre )) as
					nombre, direccion, concat(telefono,' - ',celular) as telefono,barrionombre,fechaNacimiento,email,
					contacto, parentesco, telContacto
			FROM persona
			WHERE id='$id'
		";
		$resultado = @mysqli_query($mysqli,$consulta); 
		$numReg = mysqli_affected_rows($mysqli);
		if($numReg > 0)
		{
			$fila=mysqli_fetch_array($resultado);
			$noDocumento=$fila['noDocumento'];
			$nombre=$fila['nombre'];
			$direccion=$fila['direccion'];
			$telefono=$fila['telefono'];
			$barrio=$fila['barrionombre'];
			$fechaNacimiento=$fila['fechaNacimiento'];
			$email=$fila['email'];
			$contacto=$fila['contacto'];
			$parentesco=$fila['parentesco'];
			$telContacto=$fila['telContacto'];
			
		}
		else
		{
			$noDocumento="";
			$nombre="";
			$direccion="";
			$telefono="";
			$barrio="";
			$fechaNacimiento="";
			$email="";
			$contacto="";
			$parentesco="";
			$telContacto="";
		}
		mysqli_close($mysqli);
		return $numReg;		  
    }       
	
	

	
	function obtenerSemestreEstudiante($idEstudiante,$vigencia,$idPrograma)
	{
		include("../include/conexion.php");
		$semestre="";
		$consulta="
			select count(idsemestre) as conteo, idsemestre as semestre 
			from asignatura, cargaacademicaestudiante 
			where asignatura.codigo=cargaacademicaestudiante.idAsignatura 
			and codEstudiante='$idEstudiante'
			and vigencia='$vigencia'
			and cargaacademicaestudiante.idPrograma='$idPrograma'
			GROUP BY idsemestre 
			ORDER BY conteo DESC, semestre DESC LIMIT 1
			
		";
		$resultado = @mysqli_query($mysqli,$consulta); 
		
		
		$numReg = mysqli_affected_rows($mysqli);
		
		if($numReg>0)
		{
			$fila=mysqli_fetch_array($resultado);
			$semestre=$fila['semestre'];
			
		}
		mysqli_close($mysqli);
		return $semestre;		  
    }       
	
	
	function obtenerNombreSemestre($idSemestre)
	{
		include("conexion.php");
		$nombre="";
		$consulta="
			select nombre
			from semestre
			where id='$idSemestre'
			
			
		";
		$resultado = @mysqli_query($mysqli,$consulta); 
		
		
		$numReg = mysqli_affected_rows($mysqli);
		
		if($numReg > 0)
		{
			$fila=mysqli_fetch_array($resultado);
			$nombre=$fila['nombre'];
			
		}
		mysqli_close($mysqli);
		return $nombre;		  
    }      
	
	
	

?>