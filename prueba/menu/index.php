
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="../estilo/estilos.css" media="all">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	</head>
	
	<script type="text/javascript">
    function validarForm(formulario) 
    {
        if(formulario.nombre.value.length==0) 
        { //¿Tiene 0 caracteres?
            formulario.nombre.focus();  // Damos el foco al control
            alert('Debes rellenar este campo'); //Mostramos el mensaje
            return false; 
         } //devolvemos el foco  
         return true; //Si ha llegado hasta aquí, es que todo es correcto 
     }   
	</script>
	<body>
		
		<div class="container-fluid">
			<button type="button" name="buscarCl" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
			  Buscar Cliente
			</button>
			<button type="button" name="crearCl" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter2">
			  Crear Cliente
			</button>
			
			<button type="button" name="editarCl" class="btn btn-primary">Editar Cliente</button>
			
			
		<form  method="POST" action="getCliente.php">
			<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle">Buscar Cliente</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="form-group" >
					  <label for="nombre">Nombre:</label>
					  <input type="text" class="form-control" id="nombre" name="nombre">
					</div>						
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" value="buscar" name="buscar" class="btn btn-primary">Buscar</button>
				  </div>
				</div>
			  </div>
			</div>
		</form>	
		
		
		<form name="SavePerson" id="SavePerson" method="POST" action="crearCliente.php">	
			<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle">Crear Cliente</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="form-group">
					  <label for="nombre">Nombre:</label>
					  <input type="text" class="form-control" id="nombre" name="nombre">
					</div>	
					<div class="form-group">
					  <label for="direccion">Dirección:</label>
					  <input type="text" class="form-control" id="direccion" name="direccion">
					</div>
					<div class="form-group">
					  <label for="telefono">Telefono:</label>
					  <input type="text" class="form-control" id="telefono" name="telefono">
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary">Guardar</button>
				  </div>
				</div>
			  </div>
			</div>
		</form>
			
		</div>
		
		
	</body>
</html>

