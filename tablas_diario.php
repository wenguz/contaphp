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
    //$this->Cell(0,5,$fono2,0,1,'L');
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
    $this->SetFont('Times','B',14);
    // Color de fondo
    $this->SetFillColor(200,220,255);//
    // Título
    $this->Cell(0,6,"Transacciones del día",0,1,'C');
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
    //$this->SetFillColor(0, 128, 0);//color de la celda
    //$this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Cabecera
    $w = array(20,35,55,55,30,30);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();

//para cambiar color segun clase
  $this->SetFont('', '');
    $this->SetTextColor(0);
    $codc=mysqli_query($con,"SELECT clase.nombre_clase FROM clase");
    $codcu=mysqli_query($con,"SELECT cuenta.nombre_cuenta FROM cuenta");
    $numclases = mysqli_num_rows($codc);
    

     $cods=mysqli_query($con,"SELECT clase.nombre_clase, clase.id_clase FROM clase,grupo,cuenta,subcuenta Where clase.id_clase=grupo.id_clase And grupo.id_grupo=cuenta.id_grupo And cuenta.id_cuenta=subcuenta.id_cuenta");


for ($ii=0; $ii <$numclases ; $ii++) {
    $clas = mysqli_fetch_array($codc);
     $sc = mysqli_fetch_array($cods);
    // Restauración de colores y fuentes

    if($ii=$sc['id_clase'] && $clas['nombre_clase']=$sc['nombre_clase']){
            $this->SetFillColor(173, 255, 47);

        }
        elseif ($ii=1 && $clas['nombre_clase']=$sc['nombre_clase']) {
            $this->SetFillColor(255, 215, 0);
        }
        elseif ($ii=2 && $clas['nombre_clase']=$sc['nombre_clase']) {
            $this->SetFillColor(0, 191, 255);
        }
         elseif ($ii=3 && $clas['nombre_clase']=$sc['nombre_clase']) {
            $this->SetFillColor(160 ,82, 40);
        }
        elseif ($ii=4 && $clas['nombre_clase']=$sc['nombre_clase']) {
            $this->SetFillColor(255, 99, 71);
        }
        elseif ($ii=5 && $clas['nombre_clase']=$sc['nombre_clase']) {
            $this->SetFillColor(255, 80, 71);
        }
        elseif ($ii=6 && $clas['nombre_clase']=$sc['nombre_clase']) {
            $this->SetFillColor(224,235,255);
        }

}

    // Datos
    $d=0;
    $h=0;
    $fill = true;
    foreach($data as $row)
    {

        $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
        $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
        $this->Cell($w[2],6,$row[2],'LR',0,'L',$fill);
        $this->Cell($w[3],6,$row[3],'LR',0,'L',$fill);
        $this->Cell($w[4],6,$row[4],'LR',0,'R',$fill);
        $this->Cell($w[5],6,$row[5],'LR',0,'R',$fill);
        $d+=$row[4];
        $h+=$row[5];
        $this->Ln();
        $fill = !$fill;
    }
    // Línea de cierre
   $fill = !$fill;
     $this->SetFillColor(220,100,100);
     $pie = array('TOTAL',number_format($d),number_format($h));
      $p = array(165,30,30);
    for($i=0;$i<count($pie);$i++)
        $this->Cell($p[$i],7,$pie[$i],1,0,'C',true);
}
}

$pdf = new PDF('L', 'mm', 'Letter', true, 'UTF-8', false);
$pdf->SetMargins(18,18);
$cod=mysqli_query($con,"SELECT * FROM entidad where id_entidad='1'");
$valores = mysqli_fetch_array($cod);
    $title = $valores['nombre_entidad'];
    $ciudad=$valores['ciudad_entidad'];
    $direccion=$valores['direccion_entidad'];
    $fono1=$valores['fono1_entidad'];
    $fono2=$valores['fono2_entidad'];
$pdf->SetTitle($title,$direccion,$fono1,$fono2,$ciudad);
$pdf->PrintChapter(date(" m "));

// Títulos de las columnas
$header = array('NRO','FECHA','CUENTA', 'CONCEPTO','DEBE','HABER');

// Carga de datos
$data = $pdf->LoadData('Diario.txt');
$pdf->SetFont('Arial','',14);
$pdf->FancyTable($header,$data);
$pdf->Output();
ob_end_flush();
?>
