<?php
   // --- fpdfGrille.php
   require_once("../lib/fpdf185/fpdf.php");

   $pdf = new FPDF();
   // On défini les variables pour pouvoir répéter l'entête du tableau (on doit pour cela connaître le format de la page et le nombre de ligne à afficher par page)
   $hauteurPage = 297;
   $hauteurMarge = 10;
   $hauteurLigne = 7;
   $hauteurEntete = 10;
   $espaceDisponible = $hauteurPage - ($hauteurMarge + $hauteurMarge + $hauteurEntete + 12);
   $nombreDeLignes = floor($espaceDisponible / $hauteurLigne);
   


   $pdf->AddPage();
   $pdf->SetMargins(10,$hauteurMarge);
   $pdf->SetFont('Courier','',12);

   $pdf->SetDrawColor(0,0,0); // noir
   $pdf->SetFillColor(199,199,199); // gris
   $pdf->SetTextColor(0,0,0); // noir

   // --- Cell(largeur, hauteur, texte, bord, placement, alignement, remplissage, lien)
   $pdf->Cell(20, $hauteurEntete, "CODE", 1, 0, 'C', 1);
   $pdf->Cell(70, $hauteurEntete, "DEPARTEMENT", 1, 1, 'C', 1);

   try {
      $pdo = new PDO("mysql:host=localhost;dbname=cours;port=3306", "root", "");
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // --- Si on utilise ceci il faut utiliser utf8_decode 
      // --- pour afficher plus bas les caractères accentués
      $pdo->exec("SET NAMES 'UTF8'");

      $sql = "SELECT  * FROM departement";
      $curseur = $pdo->query($sql);

      $lignes = 1; // initialisation du compteur de lignes

      foreach($curseur as $enregistrement) {
          if($lignes % $nombreDeLignes == 0) { // si on a atteint la limite de 45 lignes, on ajoute une nouvelle page
              $pdf->AddPage();
              $pdf->SetFont('Courier','',12);
              $pdf->SetMargins(10,$hauteurMarge);
              $pdf->Cell(20, $hauteurEntete, "CODE", 1, 0, 'C', 1);
              $pdf->Cell(70, $hauteurEntete, "DEPARTEMENT", 1, 1, 'C', 1);
            //   $lignes = 0; // réinitialisation du compteur de lignes
          }
      
          // Cell(Largeur, Hauteur, Texte, [Bords, RC , Alignement, Remplissage, Lien])
          $pdf->Cell(20, $hauteurLigne, mb_convert_encoding($enregistrement[1], "ISO-8859-1"), 1 , 0, 'C', 0);
          $pdf->Cell(70, $hauteurLigne, mb_convert_encoding($enregistrement[2], "ISO-8859-1"), 1 , 1, 'L', 0);
          $lignes++; // incrémentation du compteur de lignes
      }
      $curseur->closeCursor();

      // --- Redirection vers le navigateur
      $pdf->Output();

      // --- Redirection vers le disque
//      $pdf->Output("F", "../outputs/villes.pdf");
//      echo "Fichier cr&eacute;&eacute; sur le disque";
   }

   catch(PDOException $e) {
      echo "Echec de l'exécution : " . $e->getMessage();
   }

   $pdo = null;
