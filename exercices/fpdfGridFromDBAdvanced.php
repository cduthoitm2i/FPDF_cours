<?php

// fpdfGridFromDBAdvanced.php
require_once("../lib/fpdf185/fpdf.php");

$pdf = new FPDF();

$pdf->AddPage();
$pdf->SetFont('Courier', '', 12);

$pdf->SetDrawColor(0, 0, 0);
$pdf->SetFillColor(199, 199, 199);
$pdf->SetTextColor(0, 0, 0);

try {
    $pdo = new PDO("mysql:host=localhost;dbname=cours;port=3306", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Si on utilise ceci il faut utiliser utf8_decode 
    // pour afficher plus bas les caractères accentues
    $pdo->exec("SET NAMES 'UTF8'");

    // Calcul de la plus longue chaîne de caractères dans la colonne [designation]
    // requête SQL MAX(CHAR_LENGTH) qui récupère la ligne comportant le plus de caractères.
    $lsSQLMaxLength = "SELECT MAX(CHAR_LENGTH(designation)) FROM produits";
    // Local Result Set = Exécute la requête SQL SELECT
    $cursor = $pdo->query($lsSQLMaxLength);
    // Extrait l'enregistrement courant
    $record = $cursor->fetch();
    // Champ n° 1 de l'enregistrement
    $length = $record[0];
    // Ferme le curseur
    $cursor->closeCursor();

    // Produit une string avec n "O"
    $string = str_repeat("O", $length + 4);

    // Taille de la string en mm
    $liMM = $pdf->getStringWidth($string);

    // L'ordre SQL
    $sql = "SELECT designation, prix, photo FROM produits";
    // Exécute l'ordre SQL type SELECT
    $cursor = $pdo->query($sql);

    // Cell(largeur, hauteur, texte, bord, placement, alignement, remplissage, lien)
    $pdf->Cell($liMM, 5, mb_convert_encoding("Désignation", "ISO-8859-1"), 1, 0, 'C', 1);
    $pdf->Cell(20, 5, "Prix", 1, 1, 'C', 1);

    // Boucle sur le curseur 
    foreach ($cursor as $record) {
        // Cell(Largeur, Hauteur, Texte, [Bords, RC , Alignement, Remplissage, Lien])
        $pdf->Cell($liMM, 5, mb_convert_encoding(" " . $record[0], "ISO-8859-1"), 1, 0, 'L', 0);
        $pdf->Cell(20, 5, $record[1], 1, 1, 'L', 0);
    }
    $cursor->closeCursor();

    // Redirection vers le navigateur
    $pdf->Output();

    // Redirection vers le disque
//      $pdf->Output("../outputs/villes.pdf");
//      echo "Fichier cr&eacute;&eacute; sur le disque";
} catch (PDOException $e) {
    echo "Echec de l'exécution : " . $e->getMessage();
}

$pdo = null;
?>