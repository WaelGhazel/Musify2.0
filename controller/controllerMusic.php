<?php

    

$controller = 'music';
  
session_start();

require_once("{$ROOT}{$DS}model{$DS}modelMusic.php");



if(isset($_REQUEST['action']))	
/* recupère l'action passée dans l'URL*/
	$action = $_REQUEST['action'];
/* NB: On a ajouté un comportement par défaut avec action=readAll.*/
	else $action="home";	

switch($action){
    case "home":
        $pagetitle = "All";
		$view = "all";
		require ("{$ROOT}{$DS}view{$DS}view.php");
		break;
	case "submit":
        $pagetitle = "Submit";
		$view = "submit";
		require ("{$ROOT}{$DS}view{$DS}view.php");
		break;
	case "submitted":
		$id=ModelMusic::$pdo->quote($_REQUEST['Title'].$_REQUEST['artist'].$_REQUEST['Release']);
		$title=ModelMusic::$pdo->quote($_REQUEST['Title']);
		$type=ModelMusic::$pdo->quote($_REQUEST['Type']);
		$lang=ModelMusic::$pdo->quote($_REQUEST['Lang']);
		$feat=ModelMusic::$pdo->quote($_REQUEST['feat']);
		$artname=ModelMusic::$pdo->quote($_REQUEST['artist']);
		$job = ModelMusic::$pdo->quote($_REQUEST['role']);
		$tel = ModelMusic::$pdo->quote($_REQUEST['phone']);
		$release = ModelMusic::$pdo->quote($_REQUEST['Release']);
		if(!file_exists("{$ROOT}{$DS}assets{$DS}uploads{$DS}songs{$DS}$artname")){
			mkdir("{$ROOT}{$DS}assets{$DS}uploads{$DS}songs{$DS}$artname");
		}
		$targetmusic = "{$ROOT}{$DS}assets{$DS}uploads{$DS}songs{$DS}$artname{$DS}";
		$file = $targetmusic.basename($_FILES['music']['name']);
		$ext = strtolower(pathinfo($file,PATHINFO_EXTENSION));
		
		if(!file_exists("{$ROOT}{$DS}assets{$DS}uploads{$DS}images{$DS}artcovers{$DS}$artname")){
		mkdir("{$ROOT}{$DS}assets{$DS}uploads{$DS}images{$DS}artcovers{$DS}$artname");
		}
		$targetartboard = "{$ROOT}{$DS}assets{$DS}uploads{$DS}images{$DS}artcovers{$DS}$artname{$DS}";
		$pic = $targetartboard.basename($_FILES['pic']['name']);
		$ext2 = strtolower(pathinfo($pic,PATHINFO_EXTENSION));
		$image = ModelMusic::$pdo->quote($pic);
		$song = ModelMusic::$pdo->quote($file);
		
		if($ext!="mp3"){
			die('<div class="m-4 alert alert-danger" role="alert">
		MP3 Only !
		</div>
		<a href="../pages/Formupload.php" class=" m-4 btn btn-danger">Back To Upload page</a>
		<br>
		');
		}
		else if($_FILES["music"]["size"] > 50000000){
			die('<div class="m-4 alert alert-danger" role="alert">
		File Too Large !
		</div>
		<a href="index.php?controller=music&action=submit" class=" m-4 btn btn-danger">Back To Upload page</a>
		');
		}else if($ext2!="jpg" && $ext2!="png" && $ext2!="jpeg"){
			die('<div class="m-4 alert alert-danger" role="alert">
		JPG/JPEG or PNG Only !
		</div>
		<a href="index.php?controller=music&action=submit" class=" m-4 btn btn-danger">Back To Upload page</a>
		<br>
		');
		}
		else if($_FILES["pic"]["size"] > 10000000){
			die('<div class="m-4 alert alert-danger" role="alert">
		File Too Large !
		</div>
		<a href="index.php?controller=music&action=submit" class=" m-4 btn btn-danger">Back To Upload page</a>
		');
		}
		$u = new ModelMusic($title, $type, $lang, $song, $image, $artname, $feat, $release, $id);
		$u->uploadsong($title, $type, $lang, $song, $image, $artname, $feat, $release, $id);
		echo('khedmt');
		if (move_uploaded_file($_FILES['music']['tmp_name'],$file) && move_uploaded_file($_FILES['pic']['tmp_name'],$pic)) {
			header('location : index.php?controller=home');
		} else {
			echo('<div class="m-4 alert alert-danger" role="alert">
			Error uploading Your File ! 
			</div>
			<a href="../index.php" class=" m-4 btn btn-warning">Back To Home page</a>
			');    
		}
		break;
	case "gigs":
		$pagetitle = "Gigs";
		$view = "gigs";
		require ("{$ROOT}{$DS}view{$DS}view.php");
		break;

	case "music":
		$pagetitle = "Music";
		$view = "music";
		require ("{$ROOT}{$DS}view{$DS}view.php");
		break;
	
	
		



}




