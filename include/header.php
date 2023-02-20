<?php if(isset($_SESSION['login'])):?>

<header>
        <nav>
            <ul>
                <li>to_do_list</li>
                <li><a href="logout.php">Deconnexion</a></li>
            </ul>
        </nav>
    </header>
<?php ;else: ?>
    <header>
        <nav>
            <ul>
                <li>to_do_list</li>
                <li><a href="#">Accueil<a></li>
              
            </ul>
        </nav>
    </header>

<?php endif;?>