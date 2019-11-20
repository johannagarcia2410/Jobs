<?php
	function obtenerDiasFechaEspecial($vigencia,$mes,&$numReg)
	{
		include("conexion.php");			
		$consulta="
		
					select fecha,day(fecha) as dia,idTipoFechaEspecial
					from fechaespecial
					where vigencia='$vigencia'
					and MONTH(fecha)=$mes
							
		";
					
		$resultado = @mysqli_query($mysqli,$consulta);  
		$numReg = mysqli_affected_rows($mysqli);
		$indice=0;		
		if($numReg>0)
		{
						
			while($fila=mysqli_fetch_array($resultado))
			{ 
				$dias[$indice][0]=	$fila['fecha']; 
				$dias[$indice][1]=	$fila['dia']; 	
				$dias[$indice][2]=	$fila['idTipoFechaEspecial']; 
				$indice++;
			}
		}
		else
		{
			$dias[0][0]="";
			$dias[0][1]="";
		}
		mysqli_close($mysqli);
		return $dias;		
		  
    }   
	
	
	
	function obtenerDiasClaseAsistencia($vigencia,$idAsignatura,$idGrupo,$idDocente,$mes)
	{
		include("conexion.php");			
		$consulta="
		
			SELECT day(fechaAsistencia) as idDia
			from asistencia
			where vigencia='$vigencia'
			and MONTH(fechaAsistencia)=$mes
			and idDocente='$idDocente'
			and idAsignatura='$idAsignatura'
			and idGrupo='$idGrupo'
							
		";
					
		$resultado = @mysqli_query($mysqli,$consulta);  
		$numReg = mysqli_affected_rows($mysqli);
		$indice=0;		
		if($numReg>0)
		{
						
			while($fila=mysqli_fetch_array($resultado))
			{ 
				$dias[$indice]=	$fila['idDia']; 	
				$indice++;
			}
		}
		else
		{
			$dias[0]="";
		}
		mysqli_close($mysqli);
		return $dias;		
		  
    }   
	




	//returna la fecha de la base de datos en formato dd/mm/aaaa
		
		function obtenerDiasClase($vigencia,$idAsignatura,$idGrupo,$idDocente)
	{
		include("conexion.php");			
		$consulta="
			select DISTINCT idDia
			from horario
			where idDocente='$idDocente'
			and idAsignatura='$idAsignatura'
			and idgrupo='$idGrupo'
			and vigencia='$vigencia'
			
		";
					
		$resultado = @mysqli_query($mysqli,$consulta);  
		$numReg = mysqli_affected_rows($mysqli);
		$indice=0;		
		if($numReg>0)
		{
						
			while($fila=mysqli_fetch_array($resultado))
			{ 
				$dias[$indice]=	$fila['idDia']; 	
				$indice++;
			}
		}
		else
		{
			$dias[0]="";
		}
		mysqli_close($mysqli);
		return $dias;		
		  
    }   
		
		
		
		
	function estaEntreLaHora($horaInicial, $horaFinal ,$horaActual)	
	{
			$hi=strtotime($horaInicial);
			$hf=strtotime($horaFinal);
			$ha=strtotime($horaActual);
			$valor=0;
			if($ha >= $hi && $ha <= $hf)
			{
			  	$valor=1;
			}
			return $valor;
	}
		
	function estaDespuesDeLaHora($horaFinal ,$horaActual)	
	{
			
			$hf=strtotime($horaFinal);
			$ha=strtotime($horaActual);
			$valor=0;
			if($ha > $hf)
			{
			  	$valor=1;
			}
			return $valor;
	}
	
	
	function obtenerFechasSemanaActual()
	{
		include("conexion.php");
		$consulta='SELECT SUBDATE(CURDATE(),WEEKDAY(now())) as primero,ADDDATE(CURDATE(),6-WEEKDAY(now())) as ultimo';	
		$resultado = @mysqli_query($mysqli,$consulta);   
		$fila = mysqli_fetch_array($resultado); 
		$primero=	$fila['primero']; 	
		$ultimo=	$fila['ultimo'];
		$vectorFecha[1]= date_format(  date_create($fila['primero'] ), 'Y-m-d');
		for($i=2;$i<=7;$i++)
		{
			
			$fecha = date_create($primero);
			date_add($fecha, date_interval_create_from_date_string('1 days'));
			$vectorFecha[$i]=date_format($fecha, 'Y-m-d');
			$primero=$vectorFecha[$i];
			
		}
		
		return $vectorFecha;
		
		
		
    }     
		
	function obtenerHora($idHora)
	{
		
		include("conexion.php");
		$consulta="SELECT horaFin
		from hora
		where id='$idHora'
		
		";	
		
		$resultado = @mysqli_query($mysqli,$consulta);  
		$numReg = mysqli_affected_rows($mysqli);
		 
		if($numReg > 0)
		{
			$fila = mysqli_fetch_array($resultado); 
			$hora=	$fila['horaFin']; 
		}
		
	
		return $hora;		  
    }  
	
	function obtenerFecha()
	{
		include("conexion.php");
		$consulta='SELECT DATE_FORMAT(CURDATE(),"%d/%m/%Y") as fecha';	
		$resultado = @mysqli_query($mysqli,$consulta);   
		$fila = mysqli_fetch_array($resultado); 
		$fecha=	$fila['fecha']; 	
		return $fecha;		  
    }       
	
	function obtenerFechaAMD()
	{
		include("conexion.php");
		$consulta='SELECT DATE_FORMAT(CURDATE(),"%y-%m-%d") as fecha';	
		$resultado = @mysqli_query($mysqli,$consulta);   
		$fila = mysqli_fetch_array($resultado); 
		$fecha=	$fila['fecha']; 	
		
		return $fecha;		  
    }       
	
	function obtenerNoDiaFecha($fecha)
	{
		include("conexion.php");
		$consulta="SELECT WEEKDAY('$fecha')+1 as dia";	
		$resultado = @mysqli_query($mysqli,$consulta);   
		$fila = mysqli_fetch_array($resultado); 
		$dia=	$fila['dia']; 	
		return $dia;		  
    }  
	
	function obtenerDiaHoy()
	{
		include("conexion.php");
		$consulta='select WEEKDAY(now())+1 as dia';	
		$resultado = @mysqli_query($mysqli,$consulta);   
		$fila = mysqli_fetch_array($resultado); 
		$dia=	$fila['dia']; 	
		return $dia;		  
    }  
	
	function obtenerHoraActual()
	{   
	   
		ini_set('date.timezone','America/Bogota');		
		$time = time();		
		$horaActual= date("H:i:s", $time);	
		
		return $horaActual;		  
    }  
	
	
	
	
	
	//Convertir 
	function convertir_dma_amd($fecha)
	{
		$dia=substr($fecha,0,2);
		$mes=substr($fecha,3,2);
		$ano=substr($fecha,6,4); 
		$fechaAMD = $ano ."-".$mes."-".$dia;
		return $fechaAMD;
	}
	
	function convertir_amd_dma($fecha)
	{
		$dia=substr($fecha,8,2);
		$mes=substr($fecha,5,2);
		$ano=substr($fecha,0,4); 
		$fechaDMA = $dia ."-".$mes."-".$ano;
		return $fechaDMA;
	}
	
	function ObtenerMesLetra($mesNumero)
	{	
		$meses = array("No Registra","Enero","Febrero","Marzo","Abril","Mayo","Junio",
		"Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		return $meses[$mesNumero];
	}
	
	function ObtenerDiaNombreCorto($diaNumero)
	{	
		$dias = array("NA","Lu","Ma","Mi","Ju","Vi","Sa","Do");
		return $dias[$diaNumero];
	}
	
	
	
	function obtenerAnoAsistencia($vigencia,$idAsignatura,$idGrupo)
	{
		include("conexion.php");			
		$consulta="
			SELECT DISTINCT max(year(fechaAsistencia)) as ano
			FROM asistencia
			WHERE vigencia=$vigencia
			and idAsignatura=$idAsignatura
			and idgrupo=$idGrupo
			
		";
					
		$resultado = @mysqli_query($mysqli,$consulta);
		
		$numReg = mysqli_affected_rows($mysqli);
		$ano=0;		
		if($numReg>0)
		{
			$fila = mysqli_fetch_array($resultado); 
			$ano = $fila['ano'];
		}
		mysqli_close($mysqli);
		return $ano;		
	
		  
    }       
	
	function obtenerFechasAsistencia($vigencia,$idAsignatura,$idGrupo)
	{
		include("conexion.php");			
		$consulta="
			SELECT DISTINCT fechaAsistencia 
			FROM asistencia
			WHERE vigencia=$vigencia
			and idAsignatura=$idAsignatura
			and idgrupo=$idGrupo
			
		";
					
		$resultado = @mysqli_query($mysqli,$consulta);  
		$numReg = mysqli_affected_rows($mysqli);
		$indice=0;		
		if($numReg>0)
		{
						
			while($fila=mysqli_fetch_array($resultado))
			{ 
				$fechas[$indice]=	$fila['fechaAsistencia']; 	
				$indice++;
			}
		}
		else
		{
			$fechas[0]="";
		}
		mysqli_close($mysqli);
		return $fechas;		
		  
    }   
	
	
	
                
 ?>