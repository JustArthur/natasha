<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="icon" type="image/png" href="https://n8n.io/favicon.ico">

    <link rel="stylesheet" href="./style/form.css">

    <title>Générer un mandat de vente</title>
</head>
    <body>
        <main>

            <div class="search-container">
                <h2>Générer un mandat de vente</h2>
                <form id="form_pdf" action="./php/generatePDF.php" method="POST" target="_blank">
                    <div class="input_box">
                        <span class="label form_required">Nom du client</span>
                        <input required type="text" name="customerLastName" id="customerLastName">

                        <p class="text_error error_field_0 hidden">Ce champ est requis</p>
                    </div>

                    <div class="wrapper marque">
                        <span class="label form_required">Marque</span>
                        <div class="select-btn">
                            <span class="select">Selectionner la marque...</span>
                            <i class="uil uil-angle-down"></i>
                        </div>
                        <div class="content">
                            <div class="search">
                                <input type="text" placeholder="Rechercher une marque...">
                            </div>
                            <ul id="carSelect" class="options"></ul>
                        </div>
                    </div>

                    <div class="input_box">
                        <span class="label form_required">Immatriculation du véhicule</span>
                        <input required type="text" name="licensePlateCar" id="licensePlateCar">

                        <p class="text_error error_field_3 hidden">Ce champ est requis</p>
                    </div>

                    <div class="input_box">
                        <input class="submit_btn" value="Générer le mandat de vente en PDF" type="submit" name="submit_btn" id="submit_btn">
                    </div>

                    <input type="hidden" name="marqueName" id="marque_id">
                </form>

            </div>
        </main>

        <script src="./js/SEARCH_SELECT_Marque.js"></script>
        <script src="./js/error_text.js"></script>
        <script src="./js/restorForm.js"></script>
    </body>
</html>