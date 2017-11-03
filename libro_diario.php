<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
function Header()
{
    global $title,$nombre,$direccion,$fono;

    // Arial bold 15
    $this->SetFont('Times','',11);
    
    // Colores de  texto
    //$this->SetTextColor(220,50,50);
    // Título
    $this->Cell(0,5,$title,0,1,'L');
    $this->Cell(0,5,$nombre,0,1,'L');
    $this->Cell(0,5,$direccion,0,1,'L');
    $this->Cell(0,5,$fono,0,1,'L');
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
    $this->SetFont('Times','B',14);
    // Color de fondo
    $this->SetFillColor(200,220,255);
    // Calculamos ancho y posición del título.
    $w = $this->GetStringWidth($label)+6;
    $this->SetX((210-$w)/2);
    // Título
    $this->Cell($w,6,"Libro Diario  $label",0,1,'C');
    // Salto de línea
    $this->Ln(4);
}

function ChapterBody($file)
{
    // Leemos el fichero
    $txt = file_get_contents($file);
    // Times 12
    $this->SetFont('Times','',11);
    // Imprimimos el texto justificado
    $this->MultiCell(0,5,$txt);
    // Salto de línea
    $this->Ln();
    // Cita en itálica
    $this->SetFont('','B',12);
    $this->Cell(0,5,'TOTAL');
}

function PrintChapter($title, $file)
{
    $this->AddPage();
    $this->ChapterTitle($title);
    $this->ChapterBody($file);
}
}

$pdf = new PDF('P','mm','Letter');
$title = 'INSTITUTO SUPERIOR DE ESTUDIOS TEOLOGICO';
$nombre='"Nuestra Señora de La Paz"';
$direccion='Av.Armentia # 511';
$fono='Telefono 81900 - 2281901';
$pdf->SetTitle($title,$nombre,$direccion,$fono);
$pdf->PrintChapter(date("d / m / y"),'reporte_compra.txt');//fpdf/tutorial/20k_c1.txt
$pdf->PrintChapter(date("d / m / y"),'reporte_compra.txt');
$pdf->Output();
$mensaje = "Los Datos Se Han exportado Correctamente";
    print "<script>alert('$mensaje'); window.location='libro_diario.php';</script>";
?>




