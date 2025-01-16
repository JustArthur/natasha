<?php
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

    //Valeur XY
    // $importXY = [
    //     [35,36], //num PDF
    //     [56, 65], //nom Prenom
    //     [80, 97], //Num CNI
    //     [45, 90], //num Tel
    //     [70, 97], //Immat
    //     [50, 97], //Model
    //     [65, 97], //TypeBoite
    //     [65, 97], //Finition
    //     [63, 97], //Nbr Mains
    //     [63, 97], //Origine
    //     [55, 157], //Frais récent
    //     [55, 163], //Frais prévoir
    //     [130, 90], //email
    //     []
    // ];

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
    //     $pdf->SetXY($importXY[$i][0]);
    //     $pdf->Write(0, $resInfo["marque"]);
    //     $i++;
    // }

    $pdf->Output('I', $pdfNameFile);
?>