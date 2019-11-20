<?php
	function obtenerNoAsistencia($idDocente,$idAsignatura,$idGrupo,$vigencia)
	{
		include("conexion.php");
		$asistencias=0;
		$consulta="
			select count(*) as asistencias
			FROM asistencia
			where idDocente='$idDocente' 
			and fechaAsistencia=CURDATE()
			and idAsignatura='$idAsignatura'
			and idGrupo='$idGrupo'
      		and vigencia='$vigencia'
			
		";
		$resultado = @mysqli_query($mysqli,$consulta); 
				
		$fila=mysqli_fetch_array($resultado);
		$asistencias=$fila['asistencias'];
		mysqli_close($mysqli);
		return $asistencias;	
	}
	
	function obtenerNoAsistenciaFecha($idDocente,$idAsignatura,$idGrupo,$vigencia,$fecha)
	{
		
		include("conexion.php");
		$asistencias=0;
		$fecha = date_create($fecha);
		$fecha=date_format($fecha, 'Y-m-d');
		$consulta="
			select count(*) as asistencias
			FROM asistencia
			where idDocente='$idDocente' 
			and fechaAsistencia='$fecha'
			and idAsignatura='$idAsignatura'
			and idGrupo='$idGrupo'
      		and vigencia='$vigencia'
			
		";
		$resultado = @mysqli_query($mysqli,$consulta); 
				
		$fila=mysqli_fetch_array($resultado);
		$asistencias=$fila['asistencias'];
		mysqli_close($mysqli);
		return $asistencias;	
	}
	
	
	
	function obtenerHoraFinAmPm($idHora)
	{
		include("conexion.php");
		$nombre="";
		$consulta="
			SELECT finAmPm as nombre
			FROM hora
			WHERE id=$idHora
			
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
	
	
	
	//Devuelve un vector con los meses digitados dentro de una vigencia
	function obtenerHorarioDocenteEnMatriz($vigencia,$idDocente)
	{
		include("conexion.php");
		$consulta="
		select 
			d.id as idDia,
			d.nombre as nombreDia,
			h.id as idHora,
			h.inicioAmPm as horaInicio,
			h.horaInicio as horaInicio24,
			h.horaFin as horaFin24,
			ho.idHora + COUNT(ho.idHora) - 1 as horaFin,
			s.nombre as nombreSalon,
			s.id as idSalon,
			ho.idGrupo as idGrupo,
			
			a.codigo as codigoAsignatura,
			a.nombre as nombreAsignatura,
			a.idSemestre as idSemestre,
			se.nombre as nombreSemestre,
			j.id as idJornada,
			j.nombre as nombreJornada,
			p.nombre as nombrePrograma
		from horario ho, hora h, dia d, salon s,jornada j, asignatura a,  semestre se,programa p
		where h.id=ho.idHora
			and d.id=ho.idDia
			and s.id=ho.idSalon
			and j.id=ho.idJornada
			and a.codigo=ho.idAsignatura
			
			and se.id=a.idSemestre
			and a.idPrograma=p.id
			and vigencia='$vigencia'
			and ho.idDocente='$idDocente'
		GROUP BY ho.idGrupo,ho.idDia,ho.idAsignatura
		order by 
				d.id, 
				h.id,
				a.nombre,
				ho.idGrupo,
				j.id
				
		";
		$resultado = @mysqli_query($mysqli,$consulta); 
		$indice=1; 
		while($fila=mysqli_fetch_array($resultado))
		{ 
			$horario[$indice][0]="horario";			
			$horario[$indice][1]=$fila['idDia'];
			$horario[$indice][2]=$fila['nombreDia'];
			$horario[$indice][3]=$fila['horaInicio'];
			$nombreHoraFin=obtenerHoraFinAmPm($fila['horaFin']);
			$horario[$indice][4]=$nombreHoraFin;
			$horario[$indice][5]=$fila['nombreSalon'];
			$horario[$indice][6]=$fila['idSalon'];
			$horario[$indice][7]=$fila['idGrupo'];
			$horario[$indice][8]=$fila['idGrupo'];
			$horario[$indice][9]=$fila['codigoAsignatura'];
			$horario[$indice][10]=$fila['nombreAsignatura'];
			$horario[$indice][11]=$fila['idSemestre'];
			$horario[$indice][12]=$fila['nombreSemestre'];
			$horario[$indice][13]=$fila['idJornada'];
			$horario[$indice][14]=$fila['nombrePrograma'];		
			$horario[$indice][15]=$fila['idHora'];	
			$horario[$indice][16]=$fila['horaFin'];	
			$horario[$indice][17]=$fila['horaInicio24'];	
			$horario[$indice][18]=$fila['horaFin24'];		
			$indice++;
		}
		$numReg=$indice-1;
		
		mysqli_close($mysqli);
		
		
				
		
		
		
		//hd horario depurado
		$hd[0][0]="horario depurado";
		$indicehd=0;
		
		$indice=1;
		
		while($indice <= $numReg)
		{
			$indicehd++;
			$hd[$indicehd][1]=$horario[$indice][1];
			$hd[$indicehd][2]=$horario[$indice][2];
			$hd[$indicehd][3]=$horario[$indice][3];
			$hd[$indicehd][4]=$horario[$indice][4];
			$hd[$indicehd][5]=$horario[$indice][5];
			$hd[$indicehd][6]=$horario[$indice][6];
			$hd[$indicehd][7]=$horario[$indice][7];
			$hd[$indicehd][8]=$horario[$indice][8];
			$hd[$indicehd][9]=$horario[$indice][9];
			$hd[$indicehd][10]=$horario[$indice][10];
			$hd[$indicehd][11]=$horario[$indice][11];
			$hd[$indicehd][12]=$horario[$indice][12];
			$hd[$indicehd][13]=$horario[$indice][13];
			$hd[$indicehd][14]=$horario[$indice][14];
			$hd[$indicehd][15]=$horario[$indice][15];
			$hd[$indicehd][16]=$horario[$indice][16];
			$hd[$indicehd][17]=$horario[$indice][17];
			$hd[$indicehd][18]=$horario[$indice][18];
			if ($indice+1 <= $numReg)
			{
				//9 es la posicion de codigoAsignatura
				if($horario[$indice][9] != $horario[$indice + 1][9] )
				{
					$indice++;                                     
				}
				else
				{
					$sw=1;
					while($indice <= $numReg && $sw==1)
					{ 
						//9 es la posicion de codigoAsignatura, 1 dia, 7 idgrupo
						if($horario[$indice][9]==@$horario[$indice+1][9] && 
						$horario[$indice][1]==@$horario[$indice+1][1] && 
						$horario[$indice][7]==@$horario[$indice+1][7])
						{
							$hd[$indicehd][4]=$horario[$indice+1][4];//4 hora fin , 3 hora inicio	
						}
						else
						{
							
							
							$sw=0;	
						}
						
						$indice++;
					
					
					
					}//fin mq
						
				}//fin else
				
				
			}
			else
			{
				$indice++;	
				
			}
		
		}//fin mq
		
		
	
		
		
		return $hd;		  
    }       

?>