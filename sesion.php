<?php
$usuario = $_POST["usuario"];   
$password = $_POST["contra"];
$intentos = 0;
include('conexion.php'); 
$result = mysqli_query($con,"SELECT a.cargo as cargo from empleado a, empleado_usuario b where a.id_empleado=b.id_empleado and  b.user='$usuario' and b.password='$password'");


while ($intentos<=3)
{
	if($row = mysqli_fetch_array($result))
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