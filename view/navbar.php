<?php

    echo('
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php?controller=home">Musify</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" href="index.php?controller=artist">Artists</a>
                <a class="nav-link" href="index.php?controller=music">music</a>
                ');
                if(empty($_SESSION['id'])){
                    echo('
                    <a class="nav-link" href="index.php?controller=login">Login</a>');
                }
                if(!empty($_SESSION['id'])){
                    echo('
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle  active" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Profile
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item d-flex " href="index.php?controller=profile&action=u&ref='.$_SESSION['id'].'"><div class="everpic"></div>My Profile</a></li>
                        <li><a class="dropdown-item" href="index.php?controller=profile&action=edit&action=e&ref='.$_SESSION['id'].'">Profile Settings</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="index.php?controller=login&action=exit">LogOut</a></li>
                    </ul>
                    </li>');
                }
                echo('
            </div>
        </div>
    </div>
    </nav>
');
?>