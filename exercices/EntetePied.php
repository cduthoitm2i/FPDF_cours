<?php
// --- EntetePied.php
require_once("../lib/fpdf185/fpdf.php");

class EntetePied extends FPDF {

    /**
     *
     */
    public function Header() {
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(0, 10, iconv('UTF-8', 'windows-1252', 'PHP et PDF'), 'B', 0, 'C');
        $this->ln();
    }

    /**
     *
     */
    public function Footer() {
        // --- Positionnement à 1,5 cm du bas (si l'unité est le mm)
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        // --- Numéro de page centré ainsi que le total de pages
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 'T', 0, 'C');
    }

}
?>