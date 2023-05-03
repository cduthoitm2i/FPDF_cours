<?php
	// --- fpdf2.php
    // on passe en text/html (et non text/pdf comme dans l'exemple 1)
	header("Content-Type: text/html;charset=UTF-8");

	// --- La bibliothèque
	require_once("../lib/fpdf185/fpdf.php");
	$fileNameOutput = "../outputs/2.pdf";

	// --- Instancie un objet fpdf
	$pdf = new FPDF();

	// --- Crée une page
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',16);
	$pdf->SetXY(10, 5);
	$pdf->Write(10,'Hello FPDF_exo2!');

	// --- Stocke le PDF sur le disque (F pour File)
    // F  = fichier
	$pdf->Output("F", $fileNameOutput);
?>

<label>Un fichier PDF dans une page HTML</label>
<br><br>
<!--on utilise la balise object-->
<object data="<?php echo $fileNameOutput ?>" width="400" height="400" type="application/pdf">
</object>
<!--on utilise la balise iframe, à ne pas utiliser avec fichier PDF car problème de référencement des fichiers PDF-->
<iframe src="<?php echo $fileNameOutput ?>" width="400" height="400" type="application/pdf">
</iframe>

