<?php 

$host_dsn="mysql:host=localhost;dbname=todolist";

$user_bdd="root";
$password_bdd="";

try
{
	$bdd = new PDO($host_dsn,$user_bdd,$password_bdd);
    //echo'connexion_reussi';
}
catch (Exception $e)
{
        die('Erreur_connexion : ' . $e->getMessage());
}

?>