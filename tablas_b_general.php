<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
function Header()
{
    global $title,$nombre,$direccion,$fono,$fecha;

    // Arial bold 15
    $this->SetFont('Times','',11);
    
    // Colores de  texto
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

function ChapterTitle($label,$fecha)
{
    // Arial 12
    $this->SetFont('Times','B',14);
    // Color de fondo
    $this->SetFillColor(200,220,255);
    // Calculamos ancho y posición del título.
    $w = $this->GetStringWidth($label)+6;
    $this->SetX((210-$w)/2);
    // Título
    $this->Cell($w,6,"Balance General",0,1,'C');
    $this->Cell($w,6,"Practicado al 31/12/$fecha",0,1,'C');
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
}

function PrintChapter($title,$fecha/*, $file*/)
{
    $this->AddPage();
    $this->ChapterTitle($title,$fecha);
    //$this->ChapterBody($file);
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
    $this->SetFillColor(224,230,250);//color de la celda
    //$this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Cabecera
    $w = array(48,30,48,30);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Restauración de colores y fuentes
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Datos
    $fill = false;
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
        $this->Cell($w[1],6,$row[1],'LR',0,'R',$fill);
        $this->Cell($w[2],6,$row[2],'LR',0,'L',$fill);
        $this->Cell($w[3],6,$row[3],'LR',0,'R',$fill);
        $this->Ln();
       
        $fill = !$fill;
    }
    $fill = !$fill;
     $this->SetFillColor(220,100,100);
     $this->SetY(-29);
     $this->Cell(0,3,'TOTAL ACTIVO  '.number_format(array_sum($row)),'',0,'',$fill);
     $this->Cell(0,0,'TOTAL PASIVO Y PATRIMONIO  '.number_format(array_sum($row)),'',0,'L',$fill);
    // Línea de cierre   
    $this->Cell(array_sum($w),0,'','T');
}
}

$pdf = new PDF();
$title = 'INSTITUTO SUPERIOR DE ESTUDIOS TEOLOGICO';
$nombre='"Nuestra Señora de La Paz"';
$direccion='Av.Armentia # 511';
$fono='Telefono 81900 - 2281901';
$pdf->SetMargins(18,18);
$pdf->SetTitle($title,$nombre,$direccion,$fono);
$pdf->PrintChapter($title,date(" y "));//fpdf/tutorial/20k_c1.txt
//$pdf->PrintChapter(date("d / m / y"));PARA QUE EN LA SIGUINETE PAGINA APARESCA ELTITULO OT5RA VEZ


// Títulos de las columnas
$header = array('ACTIVO', 'MONTO', 'PASIVO', 'MONTO');
// Carga de datos
$data = $pdf->LoadData('b_general.txt');
$pdf->SetFont('Arial','',14);
$pdf->FancyTable($header,$data);
$pdf->Output();
?>