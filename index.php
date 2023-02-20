<?php
session_start();
var_dump($_SESSION);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link CSS -->
    <link rel="stylesheet" href="./assets/style.css">
    <!-- Link Js -->
    <script defer src="./assets/js/inscription.js"></script>
    <script defer src="./assets/js/connexion.js"></script>
    <!-- Titre Document -->
    <title>To_do_list</title>
</head>

<body>

    <?php require_once('./include/header.php'); ?>

    <div class="main-container">
        <div class="container-sub-co">

            <button id="btn-subscribe">Inscription</button>
            <button id="btn-connexion">Connexion</button>
        </div>

        <div class="container-form">
        </div>

    </div>

</body>

</html>