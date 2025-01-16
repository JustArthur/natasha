<?php
    require_once "../connexionDB.php";

    $DBB = new ConnexionDB();
    $DB = $DBB->DB();

    $resBrands = $DB->prepare('SELECT immatriculation FROM vehicules ORDER BY immatriculation ASC');
    $resBrands->execute();
    $resBrands = $resBrands->fetchAll();

    $tabBrands = array();

    foreach ($resBrands as $brand) {
        $tabBrands[] = $brand['immatriculation'];
    }

    echo json_encode($tabBrands);

    $DBB->closeConnection();
?>