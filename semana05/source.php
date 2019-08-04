<?php 

include'modelo/Conexion.php';

$conexion = new Conexion();
$conexion = $conexion->get_conexion();

//op es una variable de tipo GET :recuperando desde la URL
$opcion   = $_REQUEST['op']; 

/*

case 1 => Lista
case 2 => insertar
case 3 => actualizar
case 4 => eliminar
case 5 => Consulta por ID

*/



switch ($opcion) {
	case 1:
	
    try {
    
    //Query SQL
    $query = "
     
     SELECT

     id,
     nombres,
     apellidos,
     dni,
     DATE_FORMAT(fechaingreso,'%d/%m/%Y')fechaingreso
     

     FROM empleado";

     //Sentencia Preparada
     $statement = $conexion->prepare($query);

     //Ejecutar el código SQL(Query)
     $statement->execute();

     //Array de Datos
     $result = $statement->fetchAll(PDO::FETCH_ASSOC);

     //var_dump($result);

     //JSON : Convertir el array PHP result a un objeto json
     $json  = array(

     "sEcho"                =>1,
     "iTotalRecords"        =>count($result),
     "iTotalDisplayRecords" =>count($result),
     "aaData"               =>$result

     );

     echo json_encode($json);

    	
    } catch (Exception $e) {

    echo "Error: ".$e->getMessage();
    	
    }

		break;

	case 2:
	//Agregar
    //variables

    $nombres      = trim($_REQUEST['nombres']);
    $apellidos    = trim($_REQUEST['apellidos']);
    $dni          = trim($_REQUEST['dni']);
    $fechaingreso = trim($_REQUEST['fechaingreso']);

    try {
    	
    $query = "INSERT INTO empleado
    (nombres,apellidos,dni,fechaingreso)
    VALUES
    (:nombres,:apellidos,:dni,:fechaingreso)";

    //Sentencia Preparada
    $statement = $conexion->prepare($query);
      
    //Asignar valores a las referencias
    $statement->bindParam(':nombres',$nombres);
    $statement->bindParam(':apellidos',$apellidos);
    $statement->bindParam(':dni',$dni);
    $statement->bindParam(':fechaingreso',$fechaingreso);

    //Ejecutar el código SQL(Query)
    $statement->execute();

    
    //Mensaje

    echo json_encode(
    
    array(
   
    'title'=>'Buen Trabajo',
    'text' =>'Registro Agregado',
    'type' =>'success'

    )

    );
    
    
    } catch (Exception $e) {
    	
    
    echo json_encode(

    array(
    
    'title'=>'Error',
    'text' => $e->getMessage(),
    'type' => 'error'

    )

    );
  

    }


		break;

	case 3:
	//Actualizar
    //variables
    
    $id           = trim($_REQUEST['id']);
    $nombres      = trim($_REQUEST['nombres']);
    $apellidos    = trim($_REQUEST['apellidos']);
    $dni          = trim($_REQUEST['dni']);
    $fechaingreso = trim($_REQUEST['fechaingreso']);

    try {

    $query =  "UPDATE empleado SET 
    
    nombres      =:nombres,
    apellidos    =:apellidos,
    dni	         =:dni,
    fechaingreso =:fechaingreso
    
    WHERE  id=:id";
   
    $statement = $conexion->prepare($query);

    $statement->bindParam(':nombres',$nombres);
    $statement->bindParam(':apellidos',$apellidos);
    $statement->bindParam(':dni',$dni);
    $statement->bindParam(':fechaingreso',$fechaingreso);
    $statement->bindParam(':id',$id);
    
    $statement->execute();

    echo json_encode(

    array(
    
    'title' => 'Buen Trabajo',
    'text'  => 'Registro Actualizado',
    'type'  => 'success'
 
    )


    );



    } catch (Exception $e) {

    echo json_encode(
   
    array(
     
     'title'=>'Error',
     'text' =>$e->getMessage(),
     'type' =>'error'

    )


    );

    	
    }

		break;

	case 4:
	
    //variables
    $id = $_REQUEST['id'];

    try {
   
    $query = "DELETE FROM empleado WHERE id=:id";

    $statement = $conexion->prepare($query);

    $statement->bindParam(':id',$id);

    $statement->execute();

    echo json_encode(

    array(

   'title' => 'Buen Trabajo',
   'text'  => 'Registro Eliminado',
   'type'  => 'success'

    )

    );

    	
    } catch (Exception $e) {
    	
    echo json_encode(

    array(
    
    'title' => 'Error',
    'text'  => $e->getMessage(),
    'type'  => 'error'

    )


    );


    }


		break;

	case 5:

	//variables
	$id = $_REQUEST['id'];

	try {
    
    $query = "
 
    SELECT 

    id,
    nombres,
    apellidos,
    dni,
    fechaingreso FROM empleado WHERE id=:id";

    $statement = $conexion->prepare($query);

    $statement->bindParam(':id',$id);

    $statement->execute();

    $result =  $statement->fetch(PDO::FETCH_ASSOC);
   
    echo json_encode($result);

	} catch (Exception $e) {
		
	 echo json_encode(

    array(
   
    'title' =>'Error',
    'text'  => $e->getMessage(),
    'type'  =>'error'


    )


	 );


	}
	



		break;
	
	default:
	echo "opción no disponible";
		break;
}




 ?>