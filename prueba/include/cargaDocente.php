<?php 
	include ("../logincues/sessiones/seguridad.php");
	include ("../logincues/sessiones/tipo.php");
	include ("../logincues/sessiones/seguridadDCABP.php");
	require('../include/conexion.php');
	include("../include/funcionesAsistencia.php");
	include("../include/funcionesFecha.php");

?>

<html>
	<head>	
		<title>Docente</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script>
			function showUser(str) {
				if (str == "") {
					document.getElementById("txtHint").innerHTML = "";
					return;
				} else {
					if (window.XMLHttpRequest) {
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp = new XMLHttpRequest();
					} else {
						// code for IE6, IE5
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
						}
					};
					xmlhttp.open("GET","getdocente.php?q="+str,true);
					xmlhttp.send();
				}
			}
		</script>
		
	</head>
	
	<body>		
		
		<div class="container">
			<br>
			<div class="panel-group">
				<div class="panel panel-primary">
					<div class="panel-heading">
						 <h4>CARGA ACADÉMICA DE DOCENTES</h4>
					</div>
					<div class="panel-body" >
						<form id="formdocente" name="formdocente">
							<br>
							<label class="control-label" >DOCENTES</label>
							<SELECT name="docente" id="docente" onchange="showUser(docente.value)">
								<option>SELECCIONE DOCENTE...</option>
								<?php 
									$conexion=mysql_connect("localhost","josesantos","6342473") or
									die("Problemas en la conexion");
									mysql_select_db("dbnewcues",$conexion) or
									die("Problemas en la selección de la base de datos");  
									mysql_query ("SET NAMES 'utf8'");
									$clavebuscadah=mysql_query("SELECT nombre, cedula FROM funcionario WHERE idTipoFuncionario='44' ",$conexion) or
									die("Problemas en el select:".mysql_error());
									while($row = mysql_fetch_array($clavebuscadah))
									{
									echo'<OPTION VALUE="'.$row['cedula'].'">'.$row['nombre'].'</OPTION>';
									}
								?>
							</SELECT>
							
						</form>
						<input class="btn btn-primary" type="button" name="btnVolver" value="Volver" onclick="history.back(-1)"  />
						<br>
							<div id="txtHint"><b> </b></div>
						<br>
					</div>
				</div>
			</div>	
		</div> 
	</body>
</html>
