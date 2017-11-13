<?PHP
require('conexion.php');
$exist = file_exists("Diario.txt");
if ($exist)
{
	$borrado = unlink("Diario.txt");
	if ($borrado == True)
	{
		echo "Se borro exitosamente el txt";
	}
}
$asiento ='SELECT Distinct(asiento.id_asiento),ficha.total_debe_ficha,ficha.total_haber_ficha,ficha.fecha_ficha,subcuenta.nombre_subcuenta,asiento.glosa_asiento,asiento.debe_asiento,asiento.haber_asiento
FROM asiento,ficha,subcuenta
where ficha.fecha_ficha=date(Y-m-d)';


 $resultado=mysqli_query($con,$asiento);
while ($row = mysqli_fetch_assoc($resultado)) {
    $fi=fopen('Diario.txt','a') or die ("No se pudo Crear el archivo");
fwrite($fi,$row['id_asiento'].';');
fwrite($fi,$row['fecha_ficha'].';');
fwrite($fi,$row['nombre_subcuenta'].';');
fwrite($fi,$row['glosa_asiento'].';');
fwrite($fi,$row['debe_asiento'].';');
fwrite($fi,$row['haber_asiento'].';');
 fwrite($fi, "".chr(13).chr(10));
 }
fclose($fi);
$mensaje = "Los Datos Se Han Exportado Correctamente";
    print "<script>alert('$mensaje'); window.location='tablas_diario.php';</script>";
?>
