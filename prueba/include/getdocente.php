<!doctype html>
<html>
	<head>
		<title>Docente</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
	</head>
<body>

<?php
	$q = @$_GET['q'];
	include('../include/conexion.php');

	if (!$mysqli) {
		exit();
	}

	$consulta="
			   SELECT COUNT(h.idHora) as horas, h.idGrupo, h.idAsignatura, h.idSalon as salon, a.nombre as nomasig, d.nombre as dia, t.horaInicio, j.nombre as jornada, p.abreviatura as prog
				FROM horario h, asignatura a, dia d, hora t, jornada j, programa p
					WHERE idDocente='$q' AND h.idAsignatura=a.codigo AND h.idDia=d.id AND h.idHora=t.id AND h.idJornada=j.id  AND a.idPrograma=p.id 
				GROUP BY h.idGrupo ORDER BY h.idDia ASC
			  ";
			  


	$resultado = mysqli_query($mysqli,$consulta);
	if (mysqli_affected_rows($mysqli)>0)
	{ ?>
		<br>
		<table name="horarioDocente" id="horarioDocente" class="table" >
			<thead>
				<tr>
					<th><p align="center" >Dia</p></th>
					<th><p align="center" >Hr.Inicio</p></th>
					<th><p align="center" >Num. Hrs</p></th>
					<th><p align="center" >Salon</p></th>
					<th><p align="center" >Programa</p></th>
					<th><p align="center" >Jornada</p></th>
					<th><p align="center" >Grupo</p></th>
					<th><p align="center" >Cod. Asignatura</p></th>
					<th><p align="center" >Asignatura</p></th>	
				</tr>
			</thead>
		
		<?php	while($fila = mysqli_fetch_array($resultado)) {
				$dia=$fila['dia'];
				$hora=$fila['horaInicio'];
				$horas=$fila['horas'];
				$salon=$fila['salon'];
				$programa=$fila['prog'];
				$jornada=$fila['jornada'];
				$grupo=$fila['idGrupo'];
				$idAsignatura=$fila['idAsignatura'];
				$nombreAsignatura=$fila['nomasig'];
		?>
		
				<tbody>
					<td><p align="center" ><?php echo $dia;?></p></td>
					<td><p align="center" ><?php echo $hora;?></p></td>
					<td><p align="center" ><?php echo $horas;?></p></td>
					<td><p align="center" ><?php echo $salon;?></p></td>
					<td><p align="center" ><?php echo $programa;?></p></td>
					<td><p align="center" ><?php echo $jornada;?></p></td>
					<td><p align="center" ><?php echo $grupo;?></p></td>
					<td><p align="center" ><?php echo $idAsignatura;?></p></td>
					<td><p align="center" ><?php echo $nombreAsignatura;?></p></td>
				</tbody>
					
		<?php }?>
		</table>
<?php }
	else
	{
		echo "No se encontraron coincidencias con los valores proporcionados...";	
	 }
	mysqli_close($mysqli);
?>
</body>
</html>

