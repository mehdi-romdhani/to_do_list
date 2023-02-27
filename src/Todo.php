<?php
//Create a user class


// private = propriete ou methode visible que dans le scope de la classe
//protected = la pro ou methode est visible que dans de la classe & des enfants
//public = la pro ou methode est accessible depuis nimporte ou tant quil y a une instance
//static  = la propriete ou la methode est accesible nimporte ou meme sans instances
// :: que quand c'est statics 

// voir le typages des variables  ?int/string
//constructeur est apelle a chaque fois qu'on instance une classe 
//utiliser des var_dump
//comment architecture votre code 
//boulot : regler des problemes 


class Todo
{


    private ?int $id_utilisateurs;
    private ?string $task;
    private ?string $date;
    private ?string $date_done;
    private ?string $status;

    public function __construct()
    {
        //empty
    }

    public function getId()
    {
        return $this->id_utilisateurs;
    }

    public function setId()
    {
        return $this->id_utilisateurs;
    }

    public static function addTask(string $task)
    {
        require_once('./include/connect.php');
        global $bdd;
        htmlspecialchars($task);
        $mess_error = "Votre champs est vide";
        $mess_done = "Bravo vous avez rajouté une tache à votre todo list";
        $id = $_SESSION['id'];
        $date = date('Y-m-d H:i:s');
        $status = 0;


        if (empty($task)) {
            return $mess_error;
        } else {


            $stmt = $bdd->prepare("INSERT INTO task(id_utilisateur,task,date,status) VALUES (:id_utilisateur,:task,:date,:status)");
            $stmt->bindParam(':id_utilisateur', $id);
            $stmt->bindParam(':task', $task);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':status', $status);
            $stmt->execute();

            $queryId = $bdd->prepare('SELECT LAST_INSERT_ID()');
            $queryId->execute();
            $id_task = $queryId->fetch(PDO::FETCH_ASSOC);

            $getTask = $bdd->prepare("SELECT task.date, task.id, utilisateurs.login, task.task, task.status FROM task INNER JOIN utilisateurs ON task.id_utilisateur=utilisateurs.id WHERE task.id=:id_task");
            $getTask->execute(["id_task" => $id_task["LAST_INSERT_ID()"]]);
            $task = $getTask->fetch(PDO::FETCH_ASSOC);

            return json_encode($task);
        }
    }

    public static function displayTask()
    {
        require_once('./include/connect.php');
        global $bdd;
        $id = $_SESSION['id'];

        $stmt = $bdd->prepare("SELECT task.date,task.id, utilisateurs.login, task.task, task.status FROM task INNER JOIN utilisateurs ON task.id_utilisateur=utilisateurs.id WHERE task.id_utilisateur=:id ORDER BY date DESC ");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');

        echo json_encode($result);
    }

    public static function updateTask()
    {
        require_once('./include/connect.php');
        global $bdd;
        $id = (int)$_POST['id_task'];
        $status = 1;

        $stmt = $bdd->prepare("UPDATE task SET task.status = :status WHERE id=:id");
        $stmt->bindParam(':status', $status);//remplace etiquette par une variable
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $result = "donee";
        
        echo json_encode($result);
    }

    public static function deleteTask(){
        require_once('./include/connect.php');
        global $bdd;

        $id=(int)$_POST['id_task'];
        $stmt = $bdd->prepare("DELETE FROM task WHERE id=:id");
        $stmt->bindParam(':id',$id);
        $stmt->execute();

        $result = "tache supprimé";

        echo json_encode($result);


    }

}
