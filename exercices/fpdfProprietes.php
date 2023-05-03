<?php
	header("Content-Type: text/html;charset=UTF-8");

	// --- fpdfProprietes.php
	require_once("../lib/fpdf185/fpdf.php");

	$pdf = new FPDF('P','mm','A4');

	// --- Définit divers propriétés
	$pdf->SetAuthor('Duthoit');
	$pdf->SetCreator('PHP');
	$pdf->SetSubject(utf8_decode('Introduction à FPDF'));
	$pdf->SetKeyWords('PDF, FPDF, PHP');
	$pdf->SetTitle("FPDF par l'exemple");

	$pdf->SetDisplayMode("fullpage", "two");

	$pdf->AddPage();
	$pdf->SetFont('Courier','B',20);
	$pdf->Write(10,utf8_decode('Première page!'));

	$pdf->AddPage();
	$pdf->Write(10, utf8_decode('Deuxième page'));

	// --- Sortie fichier
	$pdf->Output("F", "../outputs/fpdf_proprietes.pdf");
	echo "fpdf_proprietes.pdf cr&eacute;&eacute;";
?>