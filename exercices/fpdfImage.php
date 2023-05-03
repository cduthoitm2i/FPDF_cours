<?php
	// --- fpdfImage.php
	require_once("../lib/fpdf185/fpdf.php");

	$pdf = new FPDF();

	$pdf->AddPage();
	$pdf->SetFont('Arial', 'B', 16);
	$pdf->Write(10, 'Hello Paris!');
	$pdf->ln();
	$pdf->Image("../images/paris.jpg", 10, 30);
	$pdf->Output();
