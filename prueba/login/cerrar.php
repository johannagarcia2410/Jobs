<head>
<title>Cerrar Session</title>
<meta charset="UTF-8">
<meta name="description" content="Proceso para validad formularios en PHP"/>
<meta name="keywords" content="validar usuarios,php"/>
<meta name="author" content="Juan Luis Mora Blanco" />
</head>
<body>
<?php
include ("seguridad.php");
session_unset();
session_destroy();
 header("location:http://localhost:8080/new/logincues/index.php");
?>

</body>
</html>