<?php
    require_once "../connexionDB.php";

    $DBB = new ConnexionDB();
    $DB = $DBB->DB();

    $resImmatriculation = $DB->prepare('SELECT immatriculation FROM vehicules ORDER BY immatriculation ASC');
    $resImmatriculation->execute();
    $resImmatriculation = $resImmatriculation->fetchAll();

    $tabImmatriculation = array();

    foreach ($resImmatriculation as $immat) {
        $tabImmatriculation[] = $immat['immatriculation'];
    }

    echo json_encode($tabImmatriculation);

    $DBB->closeConnection();
?>