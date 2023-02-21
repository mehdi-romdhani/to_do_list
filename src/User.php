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

class User
{

    private ?int $id;
    private ?string $login;
    private ?string $password;


    function __construct()
    {
        //empty;
    }

    public function setId()
    {
        return $this->id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUser()
    {
        return $this->login;
    }

    public function getUser()
    {
        return $this->login;
    }

    public function setPassword()
    {
        return $this->password;
    }

    public function getPassword()
    {
        return $this->password;
    }


    public static function register($login, $password)
    {

        require_once('./include/connect.php');
        global $bdd;

        htmlspecialchars($login);

        $mess_error = "Le nom d'utilisateur est déjà utilisé.";
        $mess_sub = "Inscription réussie";
        $mess_empty = "Veuillez remplir tout les champs";

        if (empty($login) && empty($password)) {
            return $mess_empty;
        }
        // Vérification de l'unicité du nom d'utilisateur et de l'adresse e-mail
        $stmt = $bdd->prepare("SELECT COUNT(*) FROM utilisateurs WHERE login=:login");
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {

            return  $mess_error;
        }

        // Hachage du mot de passe
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Insertion de l'utilisateur dans la base de données
        $stmt = $bdd->prepare("INSERT INTO utilisateurs(login,password) VALUES (:login, :password)");
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':password', $password_hash);
        $stmt->execute();


        return $mess_sub;
    }

    public static function connect(string $login, string $password)
    {
        require_once('./include/connect.php');
        global $bdd;

        $mess_co_empty = "Veuillez saisir les champs";
        $mess_log_exist = "Ce compte n'existe pas";
        $mess_wrong_password = "Mot de passe incorrect";

        if (empty($login) || empty($password)) {
            return $mess_co_empty;
        }

        $stmt = $bdd->prepare("SELECT COUNT(*) FROM utilisateurs WHERE login=:login");
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count === 0) {
            return $mess_log_exist;
        } else {
            $stmt = $bdd->prepare("SELECT password,id FROM utilisateurs WHERE login=:login");
            $stmt->bindParam(':login', $login);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $password_hash = $result['password'];
            $id = $result['id'];

            if (password_verify($password, $password_hash)) {
                session_start();
                $_SESSION['login'] = $login;
                $_SESSION['id'] = $id;

                return "Connexion réussie";
            } else {
                return $mess_wrong_password;
            }
        }
    }

    public static function disconnect()
    {
        session_start();
        session_destroy();
        header("location:index.php");
        exit();
    }

  
}
