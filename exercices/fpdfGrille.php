<?php
// --- fpdfGrille.php
require_once("../lib/fpdf185/fpdf.php");

$pdf = new FPDF();

$pdf->AddPage();
$pdf->SetFont('Courier', '', 12);
// On définit des couleurs (valeurs R G B)
// Couleur des dessins
$pdf->SetDrawColor(0, 0, 0); // noir (pour la bordure du tableau)
// Couleur de remplissage
$pdf->SetFillColor(199, 199, 199); // gris (pour l'entête du tableau, trame de fond)
// Couleur du texte
$pdf->SetTextColor(0, 0, 0); // noir (pour tous le texte)

// --- Cell(largeur, hauteur, texte, bord, placement, alignement, remplissage, lien)
// On définit la taille de l'entête du tableau avec les alignements et la taille des colonnes
$pdf->Cell(30, 5, "CP", 1, 0, 'C', 1);
$pdf->Cell(70, 5, "NOM DE LA VILLE", 1, 1, 'C', 1);

try {
    $pdo = new PDO("mysql:host=localhost;dbname=cours;port=3306", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // --- Si on utilise ceci il faut utiliser utf8_decode 
    // --- pour afficher plus bas les caractères accentués
    $pdo->exec("SET NAMES 'UTF8'");

    $sql = "SELECT cp, nom_ville FROM villes";
    $curseur = $pdo->query($sql);

    foreach ($curseur as $enregistrement) {
        // Cell(Largeur, Hauteur, Texte, [Bords, RC , Alignement, Remplissage, Lien])
        $pdf->Cell(30, 5, $enregistrement[0], 1, 0, 'C', 0);

        $pdf->Cell(70, 5, iconv('UTF-8', 'windows-1252', $enregistrement[1]), 1, 1, 'L', 0);
    }
    $curseur->closeCursor();

    // --- Redirection vers le navigateur
    $pdf->Output();

    // --- Redirection vers le disque
    //      $pdf->Output("F", "../outputs/villes.pdf");
    //      echo "Fichier cr&eacute;&eacute; sur le disque";
} catch (PDOException $e) {
    echo "Echec de l'exécution : " . $e->getMessage();
}

$pdo = null;
