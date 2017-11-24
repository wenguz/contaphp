<?PHP
require('conexion.php');
$exist = file_exists("resultados.txt");
if ($exist)
{
	$borrado = unlink("resultados.txt");
	if ($borrado == True)
	{
		echo "Se borro exitosamente el txt";
	}
}
/*$mensaje = "ENTRA";
print "<script>alert('$mensaje');</script>";*/

$sacar_activos ='SELECT b.id_cuenta, b.nombre_cuenta, m.saldo
FROM mayor m, clase c, grupo g, cuenta b
where c.id_clase = g.id_clase AND
g.id_grupo = b.id_grupo AND
m.id_cuenta = b.id_cuenta AND
c.nombre_clase = "ACTIVO"';
$resultado=mysqli_query($con,$sacar_activos);

while ($row = mysqli_fetch_assoc($resultado)) {
$fi=fopen('resultados.txt','a') or die ("No se pudo Crear el archivo");
fwrite($fi,$row['id_cuenta'].';');
fwrite($fi,$row['nombre_cuenta'].';');
fwrite($fi,$row['saldo'].';');
$act='ACTIVO';
fwrite($fi,$act.';');
fwrite($fi,PHP_EOL);

 }


$sacar_pasivos ='SELECT b.id_cuenta, b.nombre_cuenta, m.saldo
FROM mayor m, clase c, grupo g, cuenta b
where c.id_clase = g.id_clase AND
g.id_grupo = b.id_grupo AND
m.id_cuenta = b.id_cuenta AND
c.nombre_clase = "PASIVO"';
$resultado=mysqli_query($con,$sacar_pasivos);

while ($row = mysqli_fetch_assoc($resultado)) {
$fi=fopen('resultados.txt','a') or die ("No se pudo Crear el archivo");
fwrite($fi,$row['id_cuenta'].';');
fwrite($fi,$row['nombre_cuenta'].';');
fwrite($fi,$row['saldo'].';');
$act='PASIVO';
fwrite($fi,$act.';');
fwrite($fi,PHP_EOL);
 }


$sacar_patrimonio ='SELECT b.id_cuenta, b.nombre_cuenta, m.saldo
FROM mayor m, clase c, grupo g, cuenta b
where c.id_clase = g.id_clase AND
g.id_grupo = b.id_grupo AND
m.id_cuenta = b.id_cuenta AND
c.nombre_clase = "patrimonio"';
$resultado1=mysqli_query($con,$sacar_patrimonio);

while ($row = mysqli_fetch_assoc($resultado1)) {
$fi=fopen('resultados.txt','a') or die ("No se pudo Crear el archivo");
fwrite($fi,$row['id_cuenta'].';');
fwrite($fi,$row['nombre_cuenta'].';');
fwrite($fi,$row['saldo'].';');
$act='PATRIMONIO';
fwrite($fi,$act.';');
fwrite($fi,PHP_EOL);
 }


$sacar_ingresos ='SELECT b.id_cuenta, b.nombre_cuenta, m.saldo
FROM mayor m, clase c, grupo g, cuenta b
where c.id_clase = g.id_clase AND
g.id_grupo = b.id_grupo AND
m.id_cuenta = b.id_cuenta AND
c.nombre_clase = "INGRESOS"';
$resultado2=mysqli_query($con,$sacar_ingresos);

while ($row = mysqli_fetch_assoc($resultado2)) {
$fi=fopen('resultados.txt','a') or die ("No se pudo Crear el archivo");
fwrite($fi,$row['id_cuenta'].';');
fwrite($fi,$row['nombre_cuenta'].';');
fwrite($fi,$row['saldo'].';');
$act='INGRESOS';
fwrite($fi,$act.';');
fwrite($fi,PHP_EOL);
 }


$sacar_egreso ='SELECT b.id_cuenta, b.nombre_cuenta, m.saldo
FROM mayor m, clase c, grupo g, cuenta b
where c.id_clase = g.id_clase AND
g.id_grupo = b.id_grupo AND
m.id_cuenta = b.id_cuenta AND
c.nombre_clase = "EGRESO"';
$resultado3=mysqli_query($con,$sacar_egreso);

while ($row = mysqli_fetch_assoc($resultado3)) {
$fi=fopen('resultados.txt','a') or die ("No se pudo Crear el archivo");
fwrite($fi,$row['id_cuenta'].';');
fwrite($fi,$row['nombre_cuenta'].';');
fwrite($fi,$row['saldo'].';');
$act='EGRESO';
fwrite($fi,$act.';');
fwrite($fi,PHP_EOL);
 }
fclose($fi);


$mensaje = "Los Datos Se Han Exportado Correctamente";
    print "<script>alert('$mensaje'); window.location='tablas_estado_resultados.php';</script>";
?>
