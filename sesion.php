<?php
$usuario = $_POST["usuario"];   
$password = $_POST["contra"];
$intentos = 0;
include('conexion.php'); 
$result = mysql_query("SELECT a.cargo as cargo from empleado a, usuario b, empleado_usuario c where a.id_empleado=c.id_empleado and c.id_usuario= b.id_usuario and  b.user='$usuario' and b.password='$password'");


while ($intentos<=3)
{
	if($row = mysql_fetch_array($result))
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
		alert("El Nombre y/o Clave de Usuario es Incorrecto!!!");
		location.href = "index.php";
		</script>
	  <?php       
	}
	$intentos=+1;
}
?>