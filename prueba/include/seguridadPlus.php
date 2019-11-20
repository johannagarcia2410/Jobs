<?php
 include('funcionConexion.php');
 function filtro_seguridad($valor)
 {
    /* comprueba si están activas las magic_quotes y, en caso de estarlo revierte
       su acción mediante stripslashes */
    if (get_magic_quotes_gpc()) $valor = stripslashes($valor);
    /* Abrimos una conexión con MySQL requerida para aplicar mysqli_real_escape_string */
       $objeto_filtro=obtenerConexion();
    /* con la certeza de que estamos ante la cadena original aplicamos la función
       mysql_real_escape_string a todas las cadenas no numéricas */
    if (!is_numeric($valor))
	{
	 $valor = $objeto_filtro->real_escape_string($valor) ;
	}
     /* cerramos la conexion y devolvemos el resultado*/
    $objeto_filtro->close();
    return $valor;
}
 
 
 
 if(is_array($_GET)){
            foreach ($_GET as $_GET_indice=>$_GET_valor){
                    $_GET[$_GET_indice]=filtro_seguridad($_GET_valor);
            }
    }
    if(is_array($_POST) ){
            foreach ($_POST as $_POST_indice=>$_POST_valor){
                    $_POST[$_POST_indice]= filtro_seguridad($_POST_valor);
            }
    }

?>