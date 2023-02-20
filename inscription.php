<?php
require_once('./include/connect.php');
require_once('./src/User.php');

if(isset($_POST['login_sub'])&& isset($_POST['password_sub'])){

   echo User::register($_POST['login_sub'],$_POST['password_sub']);
   die();
}
?>


<!-- if true -> display : none -->
<form action="#" method="POST" id="form_subscribe">
    <label for="login">Login</label>
    <input type="text" name="login_sub">
    <label for="password">Mot de passe</label>
    <input type="password" name="password_sub">
    <label for="confpassword">Confirmation Mot de Passe</label>
    <input type="password" name="conf_password">
    <button type="submit">Confirmation</button>
    <input type="reset" value="Effacer">
    
</form>

<p id="mess_done"></p>