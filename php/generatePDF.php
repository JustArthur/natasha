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

    $resClient = $DB->prepare('SELECT * FROM Clients WHERE email = ?');
    $resClient->execute([$_POST['customerMail']]);
    $resClient = $resClient->fetch();

    //Valeur dans la BDD - 24
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
        "jour", //jour de visite
        $_POST['prixVente'],
        $_POST['raisonVente'],
        $_POST['delayVente'],
        "prix de vente", //prix de vente souhaité
        "cambrai", // A...
        $formatter->format(time())
    ];

    //Valeur Y
    $importY = [
        55, //Num PDF
        63, // Nom Prénom
        80, //Numero CNI
        88, //tel
        97, //immat
        107, //model
        115, //type boite
        124, //finition
        134, //nbrMains
        143, //origine véhicule
        152, //Frais recent
        160, //frais prévoir
        88, //email
        97, //marque
        106, //puissance
        115, //couleur
        125, //kilome
        134, //date entre
        143, //jour visite
        173, //prix vente
        180, //raison vente
        182,// delay vente
        193, //prix de vente souhaité
        255, // A...
        255 //le...
    ];

    //Valeur X
    $importX = [
        33,//Num PDF
        56,// Nom Prénom
        65,//Numero CNI
        40,//tel
        70,//immat
        43,//model
        43,//type boite
        63,//finition
        60,//nbrMains
        63,//origine véhicule
        55,//Frais recent
        55,//frais prévoir
        122,//email
        127,//marque
        120,//puissance
        125,//couleur
        122,//kilome
        152,//date entre
        134,//jour visite
        110,//prix vente
        60,//raison vente
        150,// delay vente
        80, //prix de vente souhaité
        32,// A...
        75 //le...
    ];

    $pdfNameFile = "mandat_vente_" . $_POST['immatCar'];

    $pdf = new \setasign\Fpdi\Fpdi();

    $pageCount = $pdf->setSourceFile('../pdf/MANDAT DE VENTE NOUVEAU.pdf');
    $pageId = $pdf->importPage(1, \setasign\Fpdi\PdfReader\PageBoundaries::MEDIA_BOX);

    $pdf->addPage();
    $pdf->useImportedPage($pageId, 5, 10, 200);

    $i = 0;
    foreach($importVarPDF as $valPDF) {
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY($importX[$i], $importY[$i]);
        $pdf->Write(0, $importVarPDF[$i]);
        $i++;
    }

    $pdf->Output('I', $pdfNameFile);
?>