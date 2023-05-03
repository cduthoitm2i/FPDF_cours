<?php

// EntetePiedCatalogue.php
require_once("../lib/fpdf185/fpdf.php");

class EntetePiedCatalogue extends FPDF {

    /**
     *
     */
    public function Header() {
        // On veut que le header commence à partir de la page 2
        if ('{nb}' > 1) {
            $this->SetFont('Arial', 'B', 15);
            $this->Cell(0, 10, mb_convert_encoding('Fiche produit', 'ISO-8859-1'), 'B', 0, 'C');
            $this->ln();
        }
    }

    /**
     *
     */
    public function Footer() {
        // On veut que le footer commence à partir de la page 2
        if ('{nb}' > 1) {
            // Positionnement à 1,5 cm du bas (si l'unité est le mm)
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            // Numéro de page centré ainsi que le total de pages
            $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 'T', 0, 'C');
        }
    }
}

?>