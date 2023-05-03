<?php

/*
 * fpdfProductCatalog2023.php
 */
// On aopelle le fichier EntetePiedCatalogue.php contenant la class EntetePiedCatalogue
require_once("EntetePiedCatalogue.php");
require_once("sizeImages.php");

// Instancie un objet fpdf (à partir du fichier EntetePiedCatalogue.php)
$pdf = new EntetePiedCatalogue();
$pdf = new PDF();
$pdf->SetFont('Arial', '', 12);

// On crée notre première page
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->centreImage("../images/boissons.jpg");

// A partir de la page 2, on affiche les informations de la base de données
try {
    $pdo = new PDO("mysql:host=localhost;dbname=cours;port=3306", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Si on utilise ceci il faut utiliser utf8_decode 
    // pour afficher plus bas les caractères accentues
    $pdo->exec("SET NAMES 'UTF8'");

    // L'ordre SQL (on sélectionne la désignation, le prix et la photo de la table produits)
    $sql = "SELECT designation, prix, photo FROM produits";
    // Exécute l'ordre SQL type SELECT
    $cursor = $pdo->query($sql);

    // Boucle sur le curseur 
    foreach ($cursor as $record) {
        // Nouvelle page
        // Pour faire une page à l'italienne
        $pdf->AddPage("L");
        // Ligne suivante
        $pdf->ln();
        // Ecriture
        $pdf->Write(10, mb_convert_encoding(" " . $record["designation"], "ISO-8859-1"));
        $pdf->ln();
        // On remplace par la virgule à la place du point décimal
        $prix = str_replace(".", ",", $record["prix"]);
        $pdf->Write(10, " " . $prix . " " . mb_convert_encoding(chr(194) . chr(128), "ISO-8859-1"));
        $pdf->ln();
        $image = $record["photo"];
        // On test la raison du non affichage d'une photo
        // Aussi bien chaîne vide que null (if($image == "" || $image != null)) {
        if (empty($image)) {
            $pdf->write(10, mb_convert_encoding("L'image n'est pas renseignée dans la colonne photo", "ISO-8859-1"));
        } else {
            // Le fichier image n'est pas présent sur le DD
            if (!file_exists("../images/" . $image)) {
                $pdf->write(10, mb_convert_encoding("L'image n'est pas présente sur le serveur", "ISO-8859-1"));
            } else {
                $pdf->Image("../images/" . $image);
            }
        }
    }
    $cursor->closeCursor();
} catch (PDOException $e) {
    $message = $e->getMessage();
}

$pdf->Output();
?>
