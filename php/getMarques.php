<?php
    require_once "../connexionDB.php";

    $DBB = new ConnexionDB();
    $DB = $DBB->DB();

    $resBrands = $DB->prepare('SELECT marque FROM vehicules ORDER BY marque ASC');
    $resBrands->execute();
    $resBrands = $resBrands->fetchAll();

    $tabBrands = array();

    foreach ($resBrands as $brand) {
        $tabBrands[] = $brand['marque'];
    }

    echo json_encode($tabBrands);

    $DBB->closeConnection();
?>