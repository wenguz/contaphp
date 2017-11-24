<?PHP
require('conexion.php');
$exist = file_exists("Mayor.txt");
if ($exist)
{
	$borrado = unlink("Mayor.txt");
	if ($borrado == True)
	{
		echo "Se borro exitosamente el txt";
	}
}
/*$mensaje = "ENTRA";
print "<script>alert('$mensaje');</script>";*/

$ing ='SELECT a.id_subcuenta,sum(a.debe_asiento) as da ,sum(a.haber_asiento)as ha, f.fecha_ficha FROM asiento a,ficha f,subcuenta s, cuenta c WHERE c.id_cuenta = s.id_cuenta AND s.id_subcuenta = a.id_subcuenta or c.id_cuenta = a.id_subcuenta AND a.ficha_id_ficha = f.id_ficha group by a.id_subcuenta';
$resultado=mysqli_query($con,$ing);

// crear insert con codgio debe haber y el saldo
//guardar en tabla mayor
$fecha = date('Y');
$fecha_mes = date('m');

$sq_mayor= mysqli_query($con,"INSERT INTO mayor SELECT NULL, a.id_subcuenta,sum(a.debe_asiento) as da ,sum(a.haber_asiento)as ha, '$saldo', '$fecha_mes' , '$fecha' FROM asiento a,ficha f,subcuenta s, cuenta c WHERE c.id_cuenta = s.id_cuenta AND s.id_subcuenta = a.id_subcuenta or c.id_cuenta = a.id_subcuenta AND a.ficha_id_ficha = f.id_ficha group by a.id_subcuenta ORDER BY `da` ASC") or die(mysqli_error($con)) ;

while ($row = mysqli_fetch_assoc($resultado)) {
$fi=fopen('Mayor.txt','a') or die ("No se pudo Crear el archivo");
fwrite($fi,$row['id_subcuenta'].';');
fwrite($fi,$row['fecha_ficha'].';');

fwrite($fi,$row['da'].';');
fwrite($fi,$row['ha'].';');
if($row['da']<$row['ha'])
{
	$saldo=$row['ha']-$row['da'];
	fwrite($fi,$saldo.';');
}
else {
	if($row['da']>$row['ha'])
	{
		$saldo=$row['da']-$row['ha'];
		fwrite($fi,$saldo.';');
	}
}

$cod_cuenta=$row['id_subcuenta'];
//$nom_cuenta=$row['nombre_cuenta'];
$debe=$row['da'];
$haber=$row['ha'];

//query encargado de actualizar datos de la tabla resultados
$agregar =mysqli_query($con, "UPDATE resultados set monto_debe='$debe', monto_haber='$haber', anio='$fecha'
 where cod_cuenta = $cod_cuenta") or die(mysqli_error($con)) ;
//agregar a la tabla mayor
$agregar_mayor =mysqli_query($con, "UPDATE mayor set debe='$debe', haber='$haber', saldo='$saldo' where id_cuenta = $cod_cuenta") or die(mysqli_error($con)) ;


 fwrite($fi, "".chr(13).chr(10));


 }
fclose($fi);
$mensaje = "Los Datos Se Han Exportado Correctamente";
    print "<script>alert('$mensaje'); window.location='tablas_mayor.php';</script>";
?>
