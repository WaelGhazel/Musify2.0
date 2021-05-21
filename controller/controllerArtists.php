<?php

$controller = 'artist';

session_start();

require_once("{$ROOT}{$DS}model{$DS}modelArtist.php");


if (isset($_REQUEST['action']))
    /* recupère l'action passée dans l'URL*/
    $action = $_REQUEST['action'];
/* NB: On a ajouté un comportement par défaut avec action=readAll.*/
else $action = "home";

switch ($action) {
    case "home":
        $pagetitle = "Home";
        $view = "home";
        require("{$ROOT}{$DS}view{$DS}view.php");
        break;
    case "search":
        $pagetitle = "Search";
        $view = "search";
        require("{$ROOT}{$DS}view{$DS}view.php");
        break;
}
