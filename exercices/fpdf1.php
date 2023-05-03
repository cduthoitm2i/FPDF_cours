<?php
	// --- fpdf1.php
	header("Content-Type: application/pdf;charset=UTF-8");

	// --- La bibliothèque
	require_once("../lib/fpdf185/fpdf.php");

	// --- Instancie un objet fpdf … Portrait, mm, A4
	//$pdf = new FPDF('P','mm','A4');
	$pdf = new FPDF();

	// --- Ajoute une page
	$pdf->AddPage();

	// --- Définit la police (Famille[, style, taille]) OBLIGATOIRE
	$pdf->SetFont('Arial','B',16);

	// --- Ecrit un texte sur 10 mm de hauteur.
	$pdf->Write(10, 'Hello FPDF!');

	// --- Affiche dans le navigateur via le plugin
	$pdf->Output();

	// --- Fermeture (Facultative !!!)
	$pdf->close();
?>