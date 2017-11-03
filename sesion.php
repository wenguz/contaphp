<?php
$usuario = $_POST["usuario"];   
$password = $_POST["contra"];
$intentos = 0;
include('conexion.php'); 
/*String del SQL --- Esto sólo es una cadena de texto que posteriormente se ejecutará, aquí va tu query a realizar*/
$string ="SELECT a.cargo as cargo from empleado a, usuario b, empleado_usuario c where a.id_empleado=c.id_empleado and c.id_usuario= b.id_usuario and  b.user='$usuario' and b.password='$password'";
$result = mysqli_query($con,$string);

/*Comprobamos que se ejecutó correctamente el Query*/
if (!$result) {  ?>
    <script languaje="javascript">
		alert("Error de BD, no se pudo consultar la base de datos<br> Error MySQL:"  . mysqli_errno());
		location.href = "index.php";
		</script> 
               <?php  
exit;           
}                    
while ($intentos<=3)
{
	if($row = mysqli_fetch_assoc($result))
	{     
	 	if($row["cargo"] == 'ADMINISTRADOR')
		{
			session_start();  
			$_SESSION['usuario'] = $usuario;  
			header("Location: principal_administrador.php");  
		}
		else
		{
			if($row["cargo"] == 'CONTADOR')
			{
				session_start();  
				$_SESSION['usuario'] = $usuario;  
				header("Location: principal_contador.php");   
			}
			else
			{
			  if($row["cargo"] == 'SECRETARIA')
			{
				session_start();  
				$_SESSION['usuario'] = $usuario;  
				header("Location: principal_secretaria.php");   
			}
			else
			{
			  ?>
				<script languaje="javascript">
				alert("El Nombre y/o Clave de Usuario es Incorrecto!");
				location.href = "index.php";
				</script>
			  <?php       
			}           
			}    
		}  
	}
	else
	{
	  ?>
		<script languaje="javascript">
		alert("No existe el usuario y/o clave!!!");
		location.href = "index.php";
		</script>
	  <?php  
	      
	}
	$intentos=+1;
	/*Liberamos memoria*/
mysqli_free_result($resultado);
}
?>