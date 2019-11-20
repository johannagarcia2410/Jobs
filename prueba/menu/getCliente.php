<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
		<style>
			table, td, th {    
				border: 1px solid #000080;
				text-align: left;
			}

			table {
				border-collapse: collapse;
				width: 100%;
				
			}

			th, td {
				padding: 15px;
			}
			th { 
			  background-color: navy;
			  color: white; 
			}
		</style>
	</head>
	<body>
					
				<?php
					include('../include/seguridadPlus.php');
					$nombre=$_POST['nombre'];
					include('../include/conexion.php');

					if (!$mysqli) {
						exit();
					}
					$consulta="SELECT Nombre, Direccion, Telefono FROM cliente WHERE Nombre='$nombre' ";		  
					$resultado = mysqli_query($mysqli,$consulta);
					if (mysqli_affected_rows($mysqli)>0)
					{
				 ?>		
			<div class="container">
				  <h2>Cliente </h2>          
				  <table class="table">
					<thead>
					  <tr>
						<th>Nombre</th>
						<th>Dirección</th>
						<th>Telefono</th>
					  </tr>
					</thead>
				<?php	while($fila = mysqli_fetch_array($resultado)) {
					$Nombre=$fila['Nombre'];
					$Direccion=$fila['Direccion'];
					$Telefono=$fila['Telefono'];
				
				?>
				<tbody>
				  <tr>
					<td><?php echo $Nombre;?></td>
					<td><?php echo $Direccion;?></td>
					<td><?php echo $Telefono;?></td>				
				  </tr>				 
				</tbody>
					
				<?php 
				   } //fin blucle
				?>
				
			  </table>
		<?php
			} // fin if 
			
		?>
			</div>  
		
	</body>
</html>	