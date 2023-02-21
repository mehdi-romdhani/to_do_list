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
        $status = null;


        if (empty($task)) {
            return $mess_error;
        } else {

            $stmt = $bdd->prepare("INSERT INTO task(id_utilisateur,task,date,status) VALUES (:id_utilisateur,:task,:date,:status)");
            $stmt->bindParam(':id_utilisateur', $id);
            $stmt->bindParam(':task', $task);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':status', $status);
            $stmt->execute();
            return $mess_done;
        }
    }

    public static function displayTask()
    {
        require_once('./include/connect.php');
        global $bdd;
        $id = $_SESSION['id'];

        $stmt = $bdd->prepare("SELECT DATE_FORMAT(task.date, '%d/%m/%Y'), utilisateurs.login, task.task FROM task INNER JOIN utilisateurs ON task.id_utilisateur=utilisateurs.id WHERE task.id_utilisateur=:id ORDER BY date DESC ");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        
        echo json_encode($result);
    }
}
