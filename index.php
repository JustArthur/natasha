<?php
    require_once __DIR__ . "/connexionDB.php";

    $DBB = new ConnexionDB();
    $DB = $DBB->DB();

    // Exemple de requête
    $stmt = $DB->query("SELECT * FROM vehicules");
    $result = $stmt->fetchAll();

    print_r($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./style/form.css">

    <title>Document</title>
</head>
<body>
    <form action="" method="POST">

    </form>
</body>
</html>