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
    $fecha=date('Y');
    // Arial 12
    $this->SetFont('Times','B',12);
    // Color de fondo
    $this->SetFillColor(255, 255, 224);//
    // Título
    $this->Cell(0,6,"BALANCE DE COMPROBACION DE SUMAS Y SALDOS",0,1,'C');
    $this->Cell(0,6,"Practicado al 31 de Diciembre de ".$fecha,0,1,'C');
    $this->Cell(0,6,"(Expresado en bolivianos)",0,1,'C');
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

function FancyTable1($header, $data)
{
    // Colores, ancho de línea y fuente en negrita
    //$this->SetFillColor(0, 128, 0);//color de la celda
    //$this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Cabecera
    $w = array(95,60,60);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
  }
function FancyTable($header, $data)
{
    // Colores, ancho de línea y fuente en negrita
    //$this->SetFillColor(0, 128, 0);//color de la celda
    //$this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Cabecera
    $w = array(15,80,30,30,30,30);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();

//para cambiar color segun clase
  $this->SetFont('', '');
    $this->SetTextColor(0);

    // Datos
    $d=0;
    $h=0;
    $s=0;
    $a=0;
    $fill = true;
    foreach($data as $row)
    {

        $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
        $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
        $this->Cell($w[2],6,$row[2],'LR',0,'L',$fill);
        $this->Cell($w[3],6,$row[3],'LR',0,'L',$fill);
        $this->Cell($w[4],6,$row[4],'LR',0,'R',$fill);
        $this->Cell($w[5],6,$row[5],'LR',0,'R',$fill);
        //$this->Cell($w[6],6,$row[6],'LR',0,'R',$fill);
        $d+=$row[3];
        $h+=$row[4];
        $s+=$row[5];
        $a+=$row[2];
        $this->Ln();
        $fill = !$fill;
    }
    // Línea de cierre
   $fill = !$fill;
     $this->SetFillColor(188, 143, 143);
     $pie = array('TOTAL',number_format($a),number_format($d),number_format($h), number_format($s));
      $p = array(95,30,30,30,30);
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
$pdf->PrintChapter('Libro de sumas y saldos');

// Títulos de las columnas
$header1=array('','SUMAS', 'SALDOS');
$header = array('NRO','DETALLE','DEBE','HABER','DEUDOR','ACREEDOR');

// Carga de datos
$data = $pdf->LoadData('sumas_saldos.txt');
$pdf->SetFont('Arial','',11);
$pdf->FancyTable1($header1,$data);
$pdf->FancyTable($header,$data);
$pdf->Output();
ob_end_flush();
?>
