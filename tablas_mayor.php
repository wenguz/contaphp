<?php
ob_start();
require('fpdf/fpdf.php');
require('conexion.php');
class PDF extends FPDF
{
function Header()
{
    global $title,$ciudad,$direccion,$fono1,$fono2;

    // Arial bold 15
    $this->SetFont('Times','',11);
    // Título
    $this->Cell(0,5,$title,0,1,'L');
    $this->Cell(0,5,'Direccion:   '.$direccion,0,1,'L');
    $this->Cell(0,5,'Telefono/s:  '.$fono1.'-'.$fono2,0,1,'L');
     $this->Cell(0,5,$ciudad,0,1,'L');
    // Salto de línea
    $this->Ln(10);
}
function Footer()
{
    // Posición a 1,5 cm del final
    $this->SetY(-15);
    // Arial itálica 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Página '.$this->PageNo(),0,0,'R');
}

function ChapterTitle($label)
{
    // Arial 12
    $this->SetFont('Times','B',12);
    // Color de fondo
    $this->SetFillColor(255, 255, 224);//
    // Título
    $this->Cell(0,6,"LIBRO MAYOR",0,1,'C');
    // Salto de línea
    //$this->Ln(1);
}
function ChapterBody($file)
{
    // Leemos el fichero
    $txt = file_get_contents($file);
    // Times 11
    $this->SetFont('Times','',11);
    // Imprimimos el texto justificado
    $this->MultiCell(0,5,$txt);
    // Salto de línea
    //$this->Ln();
    // Cita en itálica
    $this->SetFont('','B',12);
}

function PrintChapter($file)
{
    $this->AddPage();
    $this->ChapterTitle($file);
    $this->ChapterBody($file);
}


//PARA LA TABLA
// Cargar los datos
function LoadData($file)
{
    // Leer las líneas del fichero
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
}
// Tabla coloreada
function FancyTable($header, $data)
{
    // Colores, ancho de línea y fuente en negrita
    //$this->SetFillColor(0, 128, 0);//color de la celda
    //$this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Cabecera
    $w = array(20,35,60,30,30,30);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();

//para cambiar color segun clase
  $this->SetFont('', '');
    $this->SetTextColor(0);
/*
    $codc=mysqli_query($con,"SELECT clase.nombre_clase FROM clase");
    $numclases = mysqli_num_rows($codc);

  $strConsulta = "SELECT c.id_cuenta, c.nombre_cuenta, b.fecha_ficha, SUM(b.total_ficha) + SUM(a.debe_asiento) as debe,
     SUM(a.haber_asiento) as haber, SUM(a.debe_asiento)- SUM(a.haber_asiento) as Saldo
    FROM asiento a, ficha b, tipo_transaccion tt, subcuenta sub, cuenta c, grupo g, clase cl
    WHERE
    cl.id_clase =g.id_grupo
    AND g.id_grupo = c.id_grupo
    AND c.id_cuenta=sub.id_cuenta
     AND sub.id_subcuenta = a.id_subcuenta
     AND a.ficha_id_ficha = b.id_ficha
     AND tt.id_tipo_transaccion = b.id_tipo_transaccion";
  $libm = mysqli_num_rows($listamay);

for ($ii=0; $ii <$numclases ; $ii++) {
    $clas = mysqli_fetch_array($codc);
     $my = mysqli_fetch_array($libm);
    // Restauración de colores y fuentes

    if($clas['nombre_clase']=$my['nombre_clase']){
            $pdf->SetFillColor(153,255,153);
            $pdf->SetFillColor(173,255, 47);
        }
        elseif ($ii=1 && $clas['nombre_clase']=$my['nombre_clase']) {
            $pdf->SetFillColor(255, 215, 0);
            $pdf->Row(array($clas['c.id_cuenta'], $clas['c.nombre_cuenta'] ,
            $clas['b.fecha_ficha'], $clas['debe'], $clas[' haber'], $clas['Saldo']));
        }
        elseif ($ii=2 && $clas['nombre_clase']=$my['nombre_clase']) {
            $pdf->SetFillColor(0, 191, 255);
            $pdf->Row(array($clas['c.id_cuenta'], $clas['c.nombre_cuenta'] ,
            $clas['b.fecha_ficha'], $clas['debe'], $clas[' haber'], $clas['Saldo']));
        }
         elseif ($ii=3 && $clas['nombre_clase']=$my['nombre_clase']) {
            $pdf->SetFillColor(160 ,82, 40);
            $pdf->Row(array($clas['c.id_cuenta'], $clas['c.nombre_cuenta'] ,
            $clas['b.fecha_ficha'], $clas['debe'], $clas[' haber'], $clas['Saldo']));
        }
        elseif ($ii=4 && $clas['nombre_clase']=$my['nombre_clase']) {
            $pdf->SetFillColor(255, 99, 71);
            $pdf->Row(array($clas['c.id_cuenta'], $clas['c.nombre_cuenta'] ,
            $clas['b.fecha_ficha'], $clas['debe'], $clas[' haber'], $clas['Saldo']));
        }
        elseif ($ii=5 && $clas['nombre_clase']=$my['nombre_clase']) {
            $pdf->SetFillColor(255, 80, 71);
            $pdf->Row(array($clas['c.id_cuenta'], $clas['c.nombre_cuenta'] ,
            $clas['b.fecha_ficha'], $clas['debe'], $clas[' haber'], $clas['Saldo']));
        }
        elseif ($ii=6 && $clas['nombre_clase']=$my['nombre_clase']) {
            $pdf->SetFillColor(224,235,255);
            $pdf->Row(array($clas['c.id_cuenta'], $clas['c.nombre_cuenta'] ,
            $clas['b.fecha_ficha'], $clas['debe'], $clas[' haber'], $clas['Saldo']));
        }

}*/

    // Datos
    $d=0;
    $h=0;
    $s=0;
    $fill = true;
    foreach($data as $row)
    {

        $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
        $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
        $this->Cell($w[2],6,$row[2],'LR',0,'L',$fill);
        $this->Cell($w[3],6,$row[3],'LR',0,'L',$fill);
        $this->Cell($w[4],6,$row[4],'LR',0,'R',$fill);
        $this->Cell($w[5],6,$row[5],'LR',0,'R',$fill);
        $d+=$row[3];
        $h+=$row[4];
        $s+=$row[5];
        $this->Ln();
        $fill = !$fill;
    }
    // Línea de cierre
   $fill = !$fill;
     $this->SetFillColor(188, 143, 143);
     $pie = array('TOTAL',number_format($d),number_format($h), number_format($s));
      $p = array(115,30,30,30);
    for($i=0;$i<count($pie);$i++)
        $this->Cell($p[$i],7,$pie[$i],1,0,'C',true);
}
}

$pdf = new PDF('L', 'mm', 'Letter', true, 'UTF-8', false);
$pdf->SetMargins(20,20,20);
  $pdf->SetFont('Times','',11);
$cod=mysqli_query($con,"SELECT * FROM entidad where id_entidad='1'");
$valores = mysqli_fetch_array($cod);
    $title = $valores['nombre_entidad'];
    $ciudad=$valores['ciudad_entidad'];
    $direccion=$valores['direccion_entidad'];
    $fono1=$valores['fono1_entidad'];
    $fono2=$valores['fono2_entidad'];
$pdf->SetTitle($title,$direccion,$fono1,$fono2,$ciudad);
$pdf->PrintChapter('Libro Mayor');

// Títulos de las columnas
$header = array('NRO','FECHA','CUENTA','DEBE','HABER','SALDO');

// Carga de datos
$data = $pdf->LoadData('Mayor.txt');
$pdf->SetFont('Arial','',11);
$pdf->FancyTable($header,$data);
$pdf->Output();
ob_end_flush();
?>
