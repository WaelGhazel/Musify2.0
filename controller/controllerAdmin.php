<?php

$controller = 'admin';

session_start();

require_once("{$ROOT}{$DS}model{$DS}modelAdmin.php");

if($_SESSION['admin']!= 1 ){
    header("location:index.php?controller=home");
}

if (isset($_REQUEST['action']))
    /* recupère l'action passée dans l'URL*/
    $action = $_REQUEST['action'];
/* NB: On a ajouté un comportement par défaut avec action=readAll.*/
else $action = "home";

switch ($action) {
    case "home":
        $pagetitle = "Home";
        $view = "home";
        require("{$ROOT}{$DS}view{$DS}admin.php");
        break;
    case "update":
        ModelAdmin::updateArtists();
        header("location:index.php?controller=admin&action=home");
        break;
    case "tables":
        $pagetitle = "Tables";
        $view = "tables";
        require("{$ROOT}{$DS}view{$DS}admin.php");
        break;
    case "songs":
        $pagetitle = "Song";
        $view = "song";
        require("{$ROOT}{$DS}view{$DS}admin.php");
        break;
    
    
}
