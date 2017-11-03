<?php 
// datos para la coneccion a mysql 
define('DB_SERVER','localhost'); 
define('DB_NAME','contabilidad'); 
define('DB_USER','root'); 
define('DB_PASS',''); 
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS); 

/*Comprobamos que la conexión se haya realizado correctamenteEn este punto, sólo hemos comprobado que el usuario de MySQL tenga acceso mediante PHP*/ 
if(!$con){  
?>
<script languaje="javascript">alert("No se ha conectado correctamente<br>Número de error de MySQL: " .
		<?php  mysqli_connect_errno()?>);
		location.href = "index.php";
</script>               
<?php           
      
}            


/*Seleccionamos Base de Datos con la que deseamos trabajar*/
$database = mysqli_select_db($con, DB_NAME);      
//      or die('No se pudo seleccionar la base de datos');
/*Comprobamos que se haya conectado correctamente a la Base de Datos seccionada*/          
if(!$database){    
?>
<script languaje="javascript">alert("No se ha conectado a la base de datos<br>Número de error de MySQL: " .
		<?php  mysqli_connect_errno()?>);
		location.href = "index.php";
</script>               
<?php  
}                  

?>

                      