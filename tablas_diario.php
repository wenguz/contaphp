<?php
require('fpdf/fpdf.php');
//require('Controlador/conexion.php');
class PDF extends FPDF
{
var $widths;
var $aligns;
function SetWidths($w)
{
    //Set the array of column widths
    $this->widths=$w;
}

function SetAligns($a)
{
    //Set the array of column alignments
    $this->aligns=$a;
}
function Row($data)
{
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=5*$nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
        
        $this->Rect($x,$y,$w,$h);

        $this->MultiCell($w,5,$data[$i],0,$a,'true');
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}
function CheckPageBreak($h)
{
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
}
function NbLines($w,$txt)
{
    //Computes the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
}

function Header()
{
    global $title,$nombre,$direccion,$fono;

    // Arial bold 15
    $this->SetFont('Times','',11);
    
    // Colores de  texto
    //$this->SetTextColor(220,50,50);
    // Título
    $this->cell(0,14,$title,0,1,'L', 0);
    $this->cell(0,14,$nombre,0,1,'L', 0);
    $this->cell(0,14,$direccion,0,1,'L', 0);
    $this->cell(0,14,$fono,0,1,'L', 0);


/*
    $this->Cell(0,5,$title,0,1,'L');
    $this->Cell(0,5,$nombre,0,1,'L');
    $this->Cell(0,5,$direccion,0,1,'L');
    $this->Cell(0,5,$fono,0,1,'L');*/
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
    $this->Cell(100,10,'Página '.$this->PageNo(),0,0,'R');
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
}

function PrintChapter($title/*, $file*/)
{
    $this->AddPage();
    $this->ChapterTitle($title);
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
    $w = array(35,18,48,36,36);
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
        $this->Cell($w[1],6,number_format($row[1]),'LR',0,'R',$fill);
        $this->Cell($w[2],6,$row[2],'LR',0,'L',$fill);
        $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
        $this->Cell($w[4],6,number_format($row[4]),'LR',0,'R',$fill);
        $this->Ln();
       
        $fill = !$fill;
    }
    $fill = !$fill;
     $this->SetFillColor(220,100,100);
     $this->SetY(-29);
     $this->Cell(0,6,'TOTAL                                                                             '.number_format(array_sum($row)),'',0,'',$fill);
    // Línea de cierre   
    $this->Cell(array_sum($w),0,'','T');
}
}

$pdf = new PDF('L','mm','Letter');
$pdf->SetMargins(20,20,20);
$pdf->Ln(10);
$title = 'INSTITUTO SUPERIOR DE ESTUDIOS TEOLOGICO';
$nombre='"Nuestra Señora de La Paz"';
$direccion='Av.Armentia # 511';
$fono='Telefono 81900 - 2281901';
$pdf->SetMargins(20,20,20);
$pdf->Ln(10);
$pdf->SetTitle($title,$nombre,$direccion,$fono);
$pdf->PrintChapter(date("d / m / y"));//fpdf/tutorial/20k_c1.txt
//$pdf->PrintChapter(date("d / m / y"));PARA QUE EN LA SIGUINETE PAGINA APARESCA ELTITULO OT5RA VEZ
$pdf->SetWidths(array(65, 60, 55, 50, 20));
for($i=0;$i<1;$i++)
{
$pdf->Row(array('FECHA', 'Numero', 'DETALLE', 'DEBE','HABER'));
}

// Títulos de las columnas
//$header = array('Fecha', 'Nº', 'Detalle', 'Debe','Haber');
// Carga de datos
$data = $pdf->LoadData('reportes_txt/diario.txt');
$pdf->SetFont('Arial','',12);
//$pdf->FancyTable($header,$data);
$pdf->Output();
?>