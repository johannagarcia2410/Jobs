	
				<?php
					
					include('../include/conexion.php');
					include('../include/seguridadPlus.php');
					$nombre=$_POST['nombre'];
					$direccion=$_POST['direccion'];
					$telefono=$_POST['telefono'];
					echo('Estoy aqui');
					if (!$mysqli) {
						exit();
					}
					$consulta="INSERT INTO cliente ( Nombre, Direccion, Telefono) 
									VALUES ($nombre, $direccion, $telefono) ";		  
					$resultado=$mysqli->query($query);
				 ?>		
	<script languaje="javascript">
		location.href = "index.php";
   </script>