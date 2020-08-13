<?php
require('fpdf.php');
//require('rotation.php');

class PDF extends FPDF
{

function Header()
{   
}

function Footer()
{
}
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Times','B',11);
$pdf->Text(10, 10,'Teste');


$pdf->SetFont('Arial','',20);
//$pdf->RotatedImage('circle.png',85,60,40,16,45);
$pdf->RotatedText(100,60,'Hello!',45);
$pdf->Output();


?>