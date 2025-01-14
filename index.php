<?php
    require_once __DIR__ . "/connexionDB.php";

    $DBB = new ConnexionDB();
    $DB = $DBB->DB();

    $query = "SELECT * FROM vehicules";
    $stmt = $DB->query($query);
    $res = $stmt->fetchAll();

    print_r($res);

    $DBB->closeConnection();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./style/form.css">

    <title>Document</title>
</head>
    <body>
        <div class="search-container">
            <h2>Rechercher un utilisateur</h2>

            <input type="text" id="customerSearch" onkeyup="filterUsers()" placeholder="Search...">

            <select id="customerSelect" name="customerSelect" onchange="console.log('id select : ' + this.value);">
                <option value="">-- Sélectionnez un utilisateur --</option>
                <?php foreach ($res as $user): ?>
                    <option value="<?= $user['id'] ?>"><?= htmlspecialchars($user['marque']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <script>
            function filterUsers() {
                const searchValue = document.getElementById('customerSearch').value.toLowerCase();
                const options = document.querySelectorAll('#customerSelect option');

                options.forEach(option => {
                    const text = option.textContent.toLowerCase();
                    option.style.display = text.includes(searchValue) ? '' : 'none';
                });
            }
        </script>
    
    </body>
</html>