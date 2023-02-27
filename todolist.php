<?php
session_start();


require_once('./include/connect.php');
require_once('./src/Todo.php');



if (isset($_POST['task'])) {

    echo Todo::addTask($_POST['task']);
    die();
}

if (isset($_GET['getTask']) && $_GET['getTask'] == 'all') {


    echo Todo::displayTask();

    die();
}

if (isset($_GET['doneTask']) && $_GET['doneTask'] == "Id") {

    echo Todo::updateTask();
    die();
}


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
    <script defer src="./assets/js/todolist.js"></script>
    <!-- Titre Document -->
    <title>To_do_list</title>
</head>

<body>

    <?php require_once('./include/header.php'); ?>
    <h1>Bienvenue sur ta TO DO LIST : <?php echo ucwords($_SESSION['login']) ?></h1>

    <div class="container-task">
        <div class="container-create-task">
            <h2>Crée une tache</h2>
            <form method="POST" id="task-form">

                <input type="text" name="task">
                <button type="submit" id="task-btn">Ajoutez</button>
                <p id="task_done"></p>
            </form>
        </div>
    </div>

    <div class="container-task-booked">
        <h2>To_do_list</h2>
        <ul id="ul_task_booked">

        </ul>
    </div>

    <div class="container-task-finish">
        <h2>Done_List</h2>
        <ul id="ul_task_finish">

        </ul>

    </div>


</body>

</html>