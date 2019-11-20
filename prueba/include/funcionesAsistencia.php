<?php
	
	
	
	function obtenerNoInasistencia($vigencia,$mes,$idEstudiante){
		include("conexion.php");
		
		$query="
			select idestudiante, count(*) totalInasistencia
				from asistencia
				where idEstudiante='$idEstudiante'
				and MONTH(fechaAsistencia)=$mes
				and vigencia='$vigencia'
				and idEstadoAsistencia=2
				group by idEstudiante
				ORDER BY idEstudiante asc
			";
			
			$resultado = @mysqli_query($mysqli,$query); 
					
			$numReg = mysqli_affected_rows($mysqli);
			$inasistencia=0;		
			if($numReg>0)
			{       	
					$fila=mysqli_fetch_array($resultado);
					$inasistencia=$fila['totalInasistencia'];
			}
			return $inasistencia;	
		
	}
	
	
	
	function obtenerMesesVigenciaDocente($vigencia,$idDocente)
	{
		include("conexion.php");
		$consulta="
			SELECT DISTINCT MONTH(fechaAsistencia) as mes
			FROM asistencia
			WHERE vigencia='$vigencia'
			and idDocente='$idDocente'
			ORDER BY mes DESC
		";
		$resultado = @mysqli_query($mysqli,$consulta); 
		$indice=0; 
		$meses[0]=0;
		
		$numReg = mysqli_affected_rows($mysqli);
				
		if($numReg>0)
		{
		
			while($fila=mysqli_fetch_array($resultado))
			{ 
				$meses[$indice]=$fila['mes'];
				$indice++;
			}
		}
		mysqli_close($mysqli);
		return $meses;		  
    }       
	
	
	
	
	
	
	
	
	//Devuelve un vector con los meses digitados dentro de una vigencia
	function obtenerMesesAsistenciaVigencia($vigencia,$idAsignatura,$idGrupo)
	{
		include("conexion.php");
		$consulta="
			SELECT DISTINCT MONTH(fechaAsistencia) as mes
			FROM asistencia
			WHERE vigencia=$vigencia
			and idAsignatura=$idAsignatura
			and idgrupo=$idGrupo
			ORDER BY mes DESC
		";
		$resultado = @mysqli_query($mysqli,$consulta); 
		$indice=0; 
		$meses[0]=0;
		
		$numReg = mysqli_affected_rows($mysqli);
				
		if($numReg<=0)
		{
         $meses[0]=0;
    	}
		else
		{
		
			while($fila=mysqli_fetch_array($resultado))
			{ 
				$meses[$indice]=$fila['mes'];
				$indice++;
			}
		}
		mysqli_close($mysqli);
		return $meses;		  
    }       
	
	//obtener observacion
	function obtenerObservacion($vigencia,$idAsignatura,$idGrupo,$fecha,$idEstudiante)
	{
		include("conexion.php");
		$consulta="
			SELECT observacion
			FROM asistencia
			WHERE vigencia=$vigencia
			and idAsignatura=$idAsignatura
			and idgrupo=$idGrupo
			and fechaAsistencia='$fecha'
			and idEstudiante=$idEstudiante
			
		";
		$resultado = @mysqli_query($mysqli,$consulta); 
		$observacion="";
		
		$numReg = mysqli_affected_rows($mysqli);
		
		if($numReg>0)
		{
			$fila=mysqli_fetch_array($resultado);
			$observacion=$fila['observacion'];
			
		}
		mysqli_close($mysqli);
		return $observacion;			  
    }    
	
		//obtener observacion
	function obtenerNumeroEstudiantesGrupoAsignatura($vigencia,$idAsignatura,$idGrupo)
	{
		include("conexion.php");
		$consulta="
				SELECT count(*) numEstudiantes
				from matricula m,persona p, cargaacademicaestudiante ca
				where p.id=m.idestudiante
				and m.vigencia=$vigencia
				and m.id=ca.idMatricula
				and ca.idAsignatura=$idAsignatura
				and ca.idGrupo=$idGrupo
		";
		$resultado = @mysqli_query($mysqli,$consulta); 
		$numEstudiantes=0;
		
		$numReg = mysqli_affected_rows($mysqli);
		
		if($numReg>0)
		{
			$fila=mysqli_fetch_array($resultado);
			$numEstudiantes=$fila['numEstudiantes'];
			
		}
		mysqli_close($mysqli);
		return $numEstudiantes;			  
    }    
	
	
	function obtenerMesesAsistenciaEstudiante($vigencia,$idEstudiante)
	{
		include("conexion.php");
		$consulta="
			SELECT DISTINCT MONTH(fechaAsistencia) as mes
			FROM asistencia
			WHERE vigencia=$vigencia
			ORDER BY mes DESC
		";
		$resultado = @mysqli_query($mysqli,$consulta); 
		$indice=0; 
		$meses[0]=0;
		
		$numReg = mysqli_affected_rows($mysqli);
				
		if($numReg>0)
		{	
			while($fila=mysqli_fetch_array($resultado))
			{ 
				$meses[$indice]=$fila['mes'];
				$indice++;
			}
		}
		mysqli_close($mysqli);
		return $meses;		  
    }  
	
	function obtenerMatrizAsignaturasSeguimientoEstudiante($vigencia,$idEstudiante)
	{
		include("conexion.php");
		$consulta="
			SELECT 	a.codigo as idAsignatura,
					a.nombre as nombreAsignatura,
					a.creditos as creditos,
					f.cedula as codDocente,
					f.nombre as nombreDocente,
					g.id as idGrupo,
					g.nombre as nombreGrupo
			FROM 	matricula m,
					cargaacademicaestudiante cae,
					funcionario f,
					cargadocente cd,
					grupo g,
					asignatura a
			WHERE 	m.idEstudiante='$idEstudiante'
					and m.id=cae.idMatricula
					and cd.idAsignatura=cae.idAsignatura
					and f.cedula=cd.idDocente
					and g.id=cd.idGrupo
					and g.id=cae.idGrupo
					and a.codigo=cae.idAsignatura
					and a.codigo=cd.idAsignatura
					and m.vigencia=$vigencia
			ORDER BY 
					nombreAsignatura
		";
		$resultado = @mysqli_query($mysqli,$consulta); 
		$indice=1; 
		
		
		$numReg = mysqli_affected_rows($mysqli);
		
		if($numReg>0)
		{	
			while($fila=mysqli_fetch_array($resultado))
			{ 
				$matriz[$indice][0]=$indice;
				$matriz[$indice][1]=$fila['idAsignatura'];
				$matriz[$indice][2]=$fila['nombreAsignatura'];
				$matriz[$indice][3]=$fila['creditos'];
				$matriz[$indice][4]=$fila['codDocente'];
				$matriz[$indice][5]=$fila['nombreDocente'];
				$matriz[$indice][6]=$fila['idGrupo'];
				$matriz[$indice][7]=$fila['nombreGrupo'];
				
				$indice++;
			}
			
		}
		$indice--;
		$matriz[0][0]=$indice;//asina en la primera posicion el numero de registros de la matriz
		mysqli_close($mysqli);
		return $matriz;		  
    }  
	
	function cargarFilaDiasAsistenciaAMatrizAsignaturasSeguimientoEstudiante($vigencia,$idEstudiante,$matriz)
	{
		include("conexion.php");
		$consulta="
			SELECT 	a.codigo as idAsignatura,
					a.nombre as nombreAsignatura,
					a.creditos as creditos,
					f.cedula as codDocente,
					f.nombre as nombreDocente,
					g.id as idGrupo,
					g.nombre as nombreGrupo
			FROM 	matricula m,
					cargaacademicaestudiante cae,
					funcionario f,
					cargadocente cd,
					grupo g,
					asignatura a
			WHERE 	m.idEstudiante='$idEstudiante'
					and m.id=cae.idMatricula
					and cd.idAsignatura=cae.idAsignatura
					and f.cedula=cd.idDocente
					and g.id=cd.idGrupo
					and g.id=cae.idGrupo
					and a.codigo=cae.idAsignatura
					and a.codigo=cd.idAsignatura
					and m.vigencia=$vigencia
			ORDER BY 
					nombreAsignatura
		";
		$resultado = @mysqli_query($mysqli,$consulta); 
		$indice=1; 
		
		
		$numReg = mysqli_affected_rows($mysqli);
				
		if($numReg>0)
		{	
			while($fila=mysqli_fetch_array($resultado))
			{ 
				$matriz[$indice][0]=$indice;
				$matriz[$indice][1]=$fila['idAsignatura'];
				$matriz[$indice][2]=$fila['nombreAsignatura'];
				$matriz[$indice][3]=$fila['creditos'];
				$matriz[$indice][4]=$fila['codDocente'];
				$matriz[$indice][5]=$fila['nombreDocente'];
				$matriz[$indice][6]=$fila['idGrupo'];
				$matriz[$indice][7]=$fila['nombreGrupo'];
				
				$indice++;
			}
			
		}
		$indice--;
		$matriz[0][0]=$indice;//asina en la primera posicion el numero de registros de la matriz
		mysqli_close($mysqli);
		return $matriz;		  
    }  
	
	function obtenerAsignarDiasAsistenciaEstudianteMatriz($vigencia,$idEstudiante,$mes,$matriz,&$indiceFinal)
	{
		$numFilas=count($matriz);
		include("conexion.php");
		$consulta="
			SELECT DISTINCT DAY(fechaAsistencia) as dia,(WEEKDAY(fechaAsistencia) + 1) as numDia ,fechaAsistencia
			FROM asistencia
			WHERE vigencia=$vigencia
			and idEstudiante='$idEstudiante'
			and MONTH(fechaAsistencia)=$mes
			ORDER BY dia
		";
		$resultado = @mysqli_query($mysqli,$consulta); 
		$indice=8; 
		$dias[0]=0;
		
		$numReg = mysqli_affected_rows($mysqli);
	
		if($numReg>0)
		{	
			while($fila=mysqli_fetch_array($resultado))
			{ 
				$matriz[0][$indice]=$fila['dia'];
				$matriz[$numFilas][$indice]=$fila['numDia'];
				$matriz[$numFilas+1][$indice]=$fila['fechaAsistencia'];
				$indiceFinal=$indice;
				$indice++;
			}
		}
		mysqli_close($mysqli);
		return $matriz;		  
    }  
	
	function obtenerAsignarAsistenciaEstudianteMatriz($vigencia,$idEstudiante,$mes,$matriz,$indiceFinal)
	{
		include("conexion.php");
		$numFilas=count($matriz);
		$indiceCol=8;
		for ($i=1;$i<=$numFilas-3;$i++)
		{
				$idAsignatura=$matriz[$i][1];
			
				for($j=$indiceCol;$j<=$indiceFinal;$j++)
				{
						$fecha=$matriz[$numFilas-1][$j];
						
						
						$consulta="
								SELECT idEstadoAsistencia
								from asistencia
								where vigencia = $vigencia
								and idAsignatura=$idAsignatura
								and idEstudiante=$idEstudiante
								and MONTH(fechaAsistencia)=$mes
								and fechaAsistencia='$fecha'
							";
						$resultado = @mysqli_query($mysqli,$consulta); 
						
						$numReg = mysqli_affected_rows($mysqli);
					 
						if($numReg>0)
						{	
							$fila=mysqli_fetch_array($resultado);
							 
							$matriz[$i][$j]=$fila['idEstadoAsistencia'];
							
						}
						
				}//fin para j
		
		}//fin para i
		mysqli_close($mysqli);
		return $matriz;		  
    }  

	
	function obtenerConsolidadoAsistencia($matriz,$indiceFinal,&$matrizPorcentaje)
	{
		$numRegistros=$matriz[0][0]; //asigna el numero de filas registros de usuario que hay en la matriz
		
		
		$matrizConsolidado[0][0]= "No. Clases";
		$matrizConsolidado[0][1]= "Asistencia";
		$matrizConsolidado[0][2]= "Puntual";
		$matrizConsolidado[0][3]= "Llegada tarde";
		$matrizConsolidado[0][4]= "Salida temprano";
		$matrizConsolidado[0][5]= "Inasistencia";
		$matrizConsolidado[0][6]= "Injustificadas";
		$matrizConsolidado[0][7]= "Justificadas";
		
		$matrizPorcentaje[0][0]= "No. Clases";
		$matrizPorcentaje[0][1]= "Asistencia";
		$matrizPorcentaje[0][2]= "Puntual";
		$matrizPorcentaje[0][3]= "Llegada tarde";
		$matrizPorcentaje[0][4]= "Salida temprano";
		$matrizPorcentaje[0][5]= "Inasistencia";
		$matrizPorcentaje[0][6]= "Injustificadas";
		$matrizPorcentaje[0][7]= "Justificadas";
		
		
		for($i=1;$i<=$numRegistros;$i++)
		{
			$contNoClases=0;
			$contAsistencia=0;
			$contPuntual=0;
			$contEntradaTarde=0;
			$contSalidaTemprano=0;
			$contInasistencia=0;
			$contInjustificado=0;
			$contJustificado=0;
			
			for($j=8;$j<=$indiceFinal;$j++)
			{
				$idEstadoAsistencia=@$matriz[$i][$j];
				if($idEstadoAsistencia>0)
				{
					$contNoClases++;
				}
				
				if($idEstadoAsistencia==1 or $idEstadoAsistencia==4 or $idEstadoAsistencia==5)
				{
					$contAsistencia++;
				}
				
				if($idEstadoAsistencia==1)
				{
					$contPuntual++;
				}
				
				if($idEstadoAsistencia==4)
				{
					$contEntradaTarde++;
				}
				
				if($idEstadoAsistencia==5)
				{
					$contSalidaTemprano++;
				}
				
				if($idEstadoAsistencia==2 or $idEstadoAsistencia==3 )
				{
					$contInasistencia++;
				}
				
				if($idEstadoAsistencia==2)
				{
					$contInjustificado++;
				}
				
				if($idEstadoAsistencia==3)
				{
					$contJustificado++;
				}
				
				
				
			}	
			$matrizConsolidado[$i][0]= $contNoClases;
			$matrizConsolidado[$i][1]= $contAsistencia;
			$matrizConsolidado[$i][2]= $contPuntual;
			$matrizConsolidado[$i][3]= $contEntradaTarde;
			$matrizConsolidado[$i][4]= $contSalidaTemprano;
			$matrizConsolidado[$i][5]= $contInasistencia;
			$matrizConsolidado[$i][6]= $contInjustificado;
			$matrizConsolidado[$i][7]= $contJustificado;
			
			$matrizPorcentaje[$i][0]= $contNoClases;
			if($contNoClases >0)
			{
				$matrizPorcentaje[$i][1]= $contAsistencia/$contNoClases*100;
				$matrizPorcentaje[$i][2]= $contPuntual/$contNoClases*100;
				$matrizPorcentaje[$i][3]= $contEntradaTarde/$contNoClases*100;
				$matrizPorcentaje[$i][4]= $contSalidaTemprano/$contNoClases*100;
				$matrizPorcentaje[$i][5]= $contInasistencia/$contNoClases*100;
				$matrizPorcentaje[$i][6]= $contInjustificado/$contNoClases*100;
				$matrizPorcentaje[$i][7]= $contJustificado/$contNoClases*100;
			}
			else
			{
				$matrizPorcentaje[$i][1]= 0;
				$matrizPorcentaje[$i][2]= 0;
				$matrizPorcentaje[$i][3]= 0;
				$matrizPorcentaje[$i][4]= 0;
				$matrizPorcentaje[$i][5]= 0;
				$matrizPorcentaje[$i][6]= 0;
				$matrizPorcentaje[$i][7]= 0;
			}
			
		}
		
		return $matrizConsolidado;
	}
	
	

?>