<?php
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    require_once('../vendor/setasign/fpdf/fpdf.php');
    require_once('../vendor/setasign/fpdi/src/autoload.php');

    require_once( "../connexionDB.php");

    date_default_timezone_set('Europe/Paris');
    $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
    

    $DBB = new ConnexionDB();
    $DB = $DBB->DB();
    
    $resVehicule = $DB->prepare('SELECT * FROM vehicules WHERE immatriculation = ?');
    $resVehicule->execute([$_POST['immatCar']]);
    $resVehicule = $resVehicule->fetch();

    $resClient = $DB->prepare('SELECT * FROM client WHERE email = ?');
    $resClient->execute([$_POST['customerMail']]);
    $resClient = $resClient->fetch();

    //Valeur dans la BDD
    $importVarPDF = [
        "", //num PDF
        $resClient['nom'] . " " . $resClient['prenom'],
        $resClient['numero_cni'],
        $resClient['telephone'],
        $resVehicule['immatriculation'],
        $resVehicule['model'],
        $resVehicule['type_boite'],
        $resVehicule['finition'],
        "", // Nbr Mains
        "", //Origine Véhicule
        $resVehicule['frais_recent'],
        $resVehicule['frais_prevoir'],
        $resClient['email'],
        $resVehicule['marque'],
        $resVehicule['puissance'], //CV
        $resVehicule['couleur'],
        $resVehicule['kilometrage'],
        $resVehicule['date_entretien'],
        "", //jour de visite
        $_POST['prixVente'],
        $_POST['raisonVente'],
        $_POST['delayVente'],
        "", // A...
        $formatter->format(time())
    ];

    //Valeur Y
    $importY = [
        
    ];

    //Valeur X
    $importX = [
        35,
        56,
        70,
        45,
        70,
        50,
        50,
        65,
        63,
        63,
        55,
        55,
        55,
        55,
        130,
        130,
        130,
        130,
        130,
        160,
        137,
        110,
        60,
        82,
        35,
        75
    ];

    $pdfNameFile = "mandat_vente_" . $importVarPDF[2];


    $pdf = new \setasign\Fpdi\Fpdi();

    $pageCount = $pdf->setSourceFile('../pdf/MANDAT DE VENTE NOUVEAU.pdf');
    $pageId = $pdf->importPage(1, \setasign\Fpdi\PdfReader\PageBoundaries::MEDIA_BOX);

    $pdf->addPage();
    $pdf->useImportedPage($pageId, 5, 10, 200);

    //Immat
    $pdf->SetFont('Helvetica');
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetXY(70, 97);
    $pdf->Write(0, $importVarPDF[1]);

    // foreach($importVarPDF as $valPDF) {
    //     $i = 0;
    //     $pdf->SetFont('Helvetica');
    //     $pdf->SetTextColor(0, 0, 0);
    //     $pdf->SetXY($importX[$i], $importY[$i]);
    //     $pdf->Write(0, $resInfo["marque"]);
    //     $i++;
    // }

    $pdf->Output('I', $pdfNameFile);
?>