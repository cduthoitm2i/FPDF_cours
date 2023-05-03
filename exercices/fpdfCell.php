<?php
	// --- fpdfCell.php
	require_once("../lib/fpdf185/fpdf.php");

	$pdf = new FPDF();

	$pdf->AddPage();
	$pdf->SetFont("Courier","",8);

	// --- Calcule la longueur du texte a afficher
	$liLargeur = $pdf->GetStringWidth("Une CELLULE dimensionnée au texte!");

	// --- Cell(Largeur, Hauteur, Texte, [Bords, RC , Alignement, Remplissage, Lien])
	$pdf->Cell($liLargeur, 10, iconv('UTF-8', 'windows-1252', "Une Cellule dimensionnée au texte!"), 1, 0, 'C');

	$pdf->Cell(0, 10, "Une cellule qui va jusqu'au bout de la ligne!", 1, 2, 'C');

	$pdf->Cell($liLargeur, 10, iconv('UTF-8', 'windows-1252', "Une cellule à la ligne suivante!"), 1, 1);

	$pdf->Cell($liLargeur, 10, iconv('UTF-8', 'windows-1252', "Une cellule à la ligne suivante!"), 1, 1);

	// --- Write(Hauteur, Texte, Lien)
	$pdf->Write(10, "Premier texte...");
	$pdf->Write(10, "Texte suivant au fil de l'eau");
	$pdf->Ln();
	$pdf->Cell(0, 10, "Une Autre Cellule!", 1, 1, "");

	$pdf->Output();
?>