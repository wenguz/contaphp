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

$ing ='SELECT c.id_cuenta, c.nombre_cuenta, f.fecha_ficha,
(SELECT SUM(f.total_debe_ficha) FROM tipo_transaccion tt WHERE tt.id_tipo_transaccion =1) as debe,
(SELECT SUM(f.total_haber_ficha) FROM tipo_transaccion tt WHERE tt.id_tipo_transaccion =2)as haber
FROM asiento a, ficha f, tipo_transaccion tt, subcuenta sc, cuenta c
WHERE tt.id_tipo_transaccion = f.id_tipo_transaccion
and f.id_ficha = a.ficha_id_ficha
and a.id_subcuenta = sc.id_subcuenta
and sc.id_cuenta = c.id_cuenta;';
$resultado=mysqli_query($con,$ing);


while ($row = mysqli_fetch_assoc($resultado)) {
$fi=fopen('Mayor.txt','a') or die ("No se pudo Crear el archivo");
fwrite($fi,$row['id_cuenta'].';');
fwrite($fi,$row['fecha_ficha'].';');
fwrite($fi,$row['nombre_cuenta'].';');
fwrite($fi,$row['debe'].';');
fwrite($fi,$row['haber'].';');
if($row['debe']<$row['haber'])
{
	$saldo=$row['haber']-$row['debe'];
	fwrite($fi,$saldo.';');
}
else {
	if($row['debe']>$row['haber'])
	{
		$saldo=$row['debe']-$row['haber'];
		fwrite($fi,$saldo.';');
	}
}

 fwrite($fi, "".chr(13).chr(10));
 }
fclose($fi);
$mensaje = "Los Datos Se Han Exportado Correctamente";
    print "<script>alert('$mensaje'); window.location='tablas_mayor.php';</script>";
?>
