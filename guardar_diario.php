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
$asiento ='SELECT a.id_asiento,f.total_debe_ficha,f.total_haber_ficha,
f.fecha_ficha,s.nombre_subcuenta,a.glosa_asiento,a.debe_asiento,a.haber_asiento
FROM asiento a,ficha f,subcuenta s, cuenta c
WHERE c.id_cuenta = s.id_cuenta
AND s.id_subcuenta = a.id_subcuenta
AND a.ficha_id_ficha = f.id_ficha';


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
