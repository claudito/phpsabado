<?php 

try {

//Código de Conexión
$conexion = new PDO(

//SQLServer
//'sqlsrv:Server=LUIS\SQLEXPRESS;database=008BDCOMUN',
'mysql:host=localhost;dbname=db_phpsabado',
'root',//usuario
'',//Contraseña
array(

PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES UTF8'

)//validación de utf8


);

//Activar Errores o Excepciones(A nivel del código SQL con el trabaje)
$conexion->setAttribute(

PDO::ATTR_ERRMODE,
PDO::ERRMODE_EXCEPTION

);


//Consulta
$query =  "
SELECT  

id,
nombres,
apellidos,
dni,
DATE_FORMAT(fechaingreso,'%d/%m/%Y')fechaingreso 
FROM empleado";

//Sentencia Preparada
$statement  = $conexion->prepare($query);

//Ejecutar el Código
$statement->execute();

//Array PHP
$result  = $statement->fetchAll(PDO::FETCH_ASSOC);

//var_dump($result);

//JSON
$json = array("data"=>$result);

echo json_encode($json);


} catch (Exception $e) {

//Errores o Excepciones

echo "Error: ".$e->getMessage();

	
}

 ?>