﻿<?php

include('../include/conexion.php');
$id = $_POST["id"];   
$password = $_POST["clave"];

$consulta= "SELECT Nombre, Clave FROM usuario WHERE Identificacion = $id";
$result = @mysqli_query($mysqli,$consulta); 

if($row = @mysqli_fetch_array($result))
{     

 if($row["Clave"] == $password)
 {

  session_start();  
  
  //Redireccionamos a la pagina: index.php
  header("Location: ../menu/index.php");  
 }
 else
 {
  //En caso que la contraseña sea incorrecta enviamos un msj y redireccionamos a login.php
  ?>
   <script languaje="javascript">
    alert("El nombre de usuario o la contraseña son incorrectos aqui toy" );
    location.href = "index.php";
   </script>
  <?php
             
 }
}
else
{
 //en caso que el nombre de administrador es incorrecto enviamos un msj y redireccionamos a login.php
?>
 <script languaje="javascript">
  alert("El nombre de usuario o la contraseña son incorrectos");
  location.href = "index.php";
 </script>
<?php  
         
}
 
//Mysql_free_result() se usa para liberar la memoria empleada al realizar una consulta
mysqli_free_result($result);
 
/*Mysql_close() se usa para cerrar la conexión a la Base de datos y es 
**necesario hacerlo para no sobrecargar al servidor, bueno en el caso de
**programar una aplicación que tendrá muchas visitas ;) .*/
mysqli_close($mysqli);

?>