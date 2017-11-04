<?php
require("conexion.php");
$prove = mysql_real_escape_string($_POST["idproovedor"]);
$query = 'SELECT * FROM grupo WHERE id_clase = "'.$prove.'"';
$result = mysql_query($query);
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
    echo '<option value="' .$row["id_grupo"]. '">' .$row["nombre_grupo"]. '</option>';
}
mysql_close($con);
?>