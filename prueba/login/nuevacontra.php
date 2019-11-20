<?php
session_start();
$cod = $_SESSION['usuario'];


?>
<html>
	<head>	
		<title>Cambio de Contraseña</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
		
	</head>
	<body style="margin:0px; margin-top:0px; margin-left:0px">

<?php
  include("../include/cabecera.php");
?>
		<br>
		<div class="container">
			<div class="panel-group">
				<div class="panel panel-primary">
					<div class="panel-heading">
					  <h4>Cambio de contraseña</h4>
					</div>
					<div class="panel-body">
						<form method="post" name="cambio" action="cambiocontra.php">
							<div class="row">
								<div class="col-md-3">
									<input class="form-control" type="password" name="oldcontra" placeholder="Ingrese antigua password" required><br>
								</div>
								<div class="col-md-3">
									<input class="form-control" type="password" name="newcontra"  placeholder="Ingrese nueva password" required>
								</div>
								<div class="col-md-3">
									<input class="form-control" type="password" name="newcontra2"  placeholder="Repita nueva password" required>
								</div>	
								<div class="col-md-3">
									<button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
								</div>
							</div>
							
						</form>
					</div>
				</div>
			</div>
		</div>	
	</body>
</html>

