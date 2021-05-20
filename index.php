<?php

$ROOT = __DIR__;
$DS = DIRECTORY_SEPARATOR;


$controleur_default = 'home';


if(!isset($_REQUEST['controller']))
    $controller = $controleur_default;

    else $controller = $_REQUEST['controller'];

    switch($controller){

      
        case 'home':
                require("{$ROOT}{$DS}controller{$DS}controllerHome.php");
                break;

                case 'admin':
                    require("{$ROOT}{$DS}controller{$DS}controllerAdmin.php");
                    break;

                    
                case 'music':
                    require("{$ROOT}{$DS}controller{$DS}controllerMusic.php");
                    break;
         
                    case 'artist':
                        require("{$ROOT}{$DS}controller{$DS}controllerArtists.php");
                        break;


                        case 'profile':
                            require("{$ROOT}{$DS}controller{$DS}controllerProfile.php");
                            break;    

                        case 'login':
                            require("{$ROOT}{$DS}controller{$DS}controllerLogin.php");
                           break;   
    }


?>
