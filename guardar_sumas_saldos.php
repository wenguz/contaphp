<?PHP
require('conexion.php');
$exist = file_exists("sumas_saldos.txt");
if ($exist)
{
	$borrado = unlink("sumas_saldos.txt");
	if ($borrado == True)
	{
		echo "Se borro exitosamente el txt";
	}
}
/*$mensaje = "ENTRA";
print "<script>alert('$mensaje');</script>";*/

$ing ='SELECT c.id_cuenta, c.nombre_cuenta,
(SELECT SUM(f.total_debe_ficha) FROM tipo_transaccion tt WHERE tt.id_tipo_transaccion =1) as debe,
(SELECT SUM(f.total_haber_ficha) FROM tipo_transaccion tt WHERE tt.id_tipo_transaccion =2)as haber
FROM asiento a, ficha f, tipo_transaccion tt, subcuenta sc, cuenta c
WHERE tt.id_tipo_transaccion = f.id_tipo_transaccion
and f.id_ficha = a.ficha_id_ficha
and a.id_subcuenta = sc.id_subcuenta
and sc.id_cuenta = c.id_cuenta;';
$resultado=mysqli_query($con,$ing);

while ($row = mysqli_fetch_assoc($resultado)) {
$fi=fopen('sumas_saldos.txt','a') or die ("No se pudo Crear el archivo");
fwrite($fi,$row['id_cuenta'].';');
fwrite($fi,$row['nombre_cuenta'].';');
fwrite($fi,$row['debe'].';');
fwrite($fi,$row['haber'].';');
if($row['debe']<$row['haber'])
{
  $deudor=$row['haber']-$row['haber'];
	$acreedr=$row['haber']-$row['debe'];
}
else {
	if($row['debe']>$row['haber'])
	{
    $acreedr=$row['debe']-$row['debe'];
		$deudor=$row['debe']-$row['haber'];
	}
  fwrite($fi,$deudor.';');
  fwrite($fi,$acreedr.';');
}

 fwrite($fi, "".chr(113).chr(110));
 }
fclose($fi);
$mensaje = "Los Datos Se Han Exportado Correctamente";
    print "<script>alert('$mensaje'); window.location='tablas_sumas_saldos.php';</script>";
?>
