<?php
session_start();
var_dump($_SESSION)
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
    <link rel="stylesheet" href="./js/todolist.js">
    <!-- Titre Document -->
    <title>To_do_list</title>
</head>

<body>

    <?php require_once('./include/header.php'); ?>
    <h1>Bienvenue sur ta TO DO LIST : <?php echo ucwords($_SESSION['login'])?></h1>

    <div class="container-task">
        <div class="container-create-task">
            <h2>Crée une tache</h2>
            <form action="#" method="POST" id="task-form">
                
                <input type="text">
                <button type="submit">Ajoutez</button>
            </form>
        </div>
    </div>

    <div class="container-task-done">
        <h2>To_do_list</h2>
    </div>

    
</body>

</html>