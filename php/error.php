<?php
    if(!isset($_GET['error'])) {
        echo "closeWindow();";
    }

    switch ($_GET['error']) {
        case 'empty':
            $messageError = "Veuillez remplir tous les champs";
            break;
            
        case 'delay':
            $messageError = "Le délai de vente doit être supérieur à 0";
            break;

        case 'client':
            $messageError = "Le client est introuvable";
            break;

        case 'date':
            $messageError = "La date de visite est incorrecte";
            break;
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../style/form.css">

    <title>Client introuvable</title>
</head>
<body>
    <main>
        <div class="search-container">
            <h2><?= $messageError ?></h2>
            <form>
                <div class="input_box">
                    <input class="submit_btn" value="Recréer un mandat de vente" onclick="closeWindow()" type="submit" name="submit_btn" id="submit_btn">
                </div>
            </form>
        </div>
    </main>

    <script>
        function closeWindow() {
            window.close();
        }
    </script>
</body>
</html>