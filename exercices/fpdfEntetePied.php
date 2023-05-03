<?php

// --- fpdfEntetePied.php
// --- Créer un PDF avec en-tête et pied de page
require_once("EntetePied.php");

// --- Instancie un objet fpdf
$pdf = new EntetePied();

$pdf->SetDisplayMode("fullpage", "two");
// --- Crée un alias pour le nombre total de pages
// --- Cet alias est utilisé dans le footer()
// --- Par défaut il est égal à {nb}
$pdf->AliasNbPages();

// --- Fixe l'épaisseur du trait
// On set l'épaisseur du trait qui se trouve avant le titre du chapitre
$pdf->SetLineWidth(0.1); // --- Par défaut 0.2
$pdf->AddPage();
$pdf->SetFont('Courier', 'B', 30);
$pdf->Cell(0, 10, 'Chapitre 1');

$pdf->AddPage();
$pdf->Cell(0, 10, 'Chapitre 2!');
$pdf->Output();
?>