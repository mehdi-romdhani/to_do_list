<?php
require_once('./include/connect.php');
require_once('./src/User.php');

if(isset($_POST['login_co'])&& isset($_POST['password_co'])){

   echo User::connect($_POST['login_co'],$_POST['password_co']);
   die();
}
?>


<!-- if true -> display : none -->
<form action="#" method="POST" id="form_connexion">
    <label for="login">Login</label>
    <input type="text" name="login_co">
    <label for="password">Mot de passe</label>
    <input type="password" name="password_co">
    <button type="submit">Connexion</button>
    
    
</form>

<p id="mess_done"></p>