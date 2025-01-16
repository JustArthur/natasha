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
                        <span class="label form_required">Adresse-mail du client</span>
                        <input required type="email" name="customerMail" id="customerMail">

                        <p class="text_error error_field_0 hidden">Ce champ est requis</p>
                    </div>

                    <div class="wrapper marque">
                        <span class="label form_required">Immatriculation du véhicule</span>
                        <div class="select-btn">
                            <span class="select">Selectionner une immatriculation...</span>
                            <i class="uil uil-angle-down"></i>
                        </div>
                        <div class="content">
                            <div class="search">
                                <input type="text" placeholder="Rechercher une immatriculation...">
                            </div>
                            <ul id="carSelect" class="options"></ul>
                        </div>
                    </div>

                    <div class="input_box">
                        <span class="label form_required">Prix de vente sur le marché</span>
                        <input required type="number" name="prixVente" id="prixVente">

                        <p class="text_error error_field_0 hidden">Ce champ est requis</p>
                    </div>

                    <div class="input_box">
                        <span class="label form_required">Raison de la vente</span>
                        <input required type="text" name="raisonVente" id="raisonVente">

                        <p class="text_error error_field_0 hidden">Ce champ est requis</p>
                    </div>

                    <div class="input_box">
                        <span class="label form_required">Delai de vente</span>
                        <input required type="date" name="delayVente" id="delayVente">

                        <p class="text_error error_field_0 hidden">Ce champ est requis</p>
                    </div>

                    <div class="input_box">
                        <input class="submit_btn" value="Générer le mandat de vente en PDF" type="submit" name="submit_btn" id="submit_btn">
                    </div>

                    <input type="hidden" name="immatCar" id="marque_id">
                </form>

            </div>
        </main>

        <script src="./js/SEARCH_SELECT_Marque.js"></script>
        <script src="./js/error_text.js"></script>
        <!-- <script src="./js/restorForm.js"></script> -->
    </body>
</html>