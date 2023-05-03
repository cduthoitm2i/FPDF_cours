<?php
	$lsFichierPDF = "../outputs/2.pdf"; // --- Dossier courant
	header("Content-type: application/pdf");
	readfile($lsFichierPDF );
?>
