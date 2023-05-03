<?php
require_once("../lib/fpdf185/fpdf.php");
class PDF extends FPDF
{
/* Page header */
function Header()
{
    
    $this->SetFont('Arial','B',15);
    /* Move to the right */
    $this->Cell(60);
  
    $this->Cell(70,10,'Page Heading',1,0,'C');
}
/* Page footer */
function Footer()
{
    /* Position at 1.5 cm from bottom */
    $this->SetY(-15);
    /* Arial italic 8 */
    $this->SetFont('Arial','I',8);
    /* Page number */
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

/* Instanciation of inherited class */
$pdf = new PDF();

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->AddPage();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

$pdf->Output();
?>