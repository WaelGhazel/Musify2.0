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
		$title=$_REQUEST['Title'];
		$type=$_REQUEST['Type'];
		$lang=$_REQUEST['Lang'];
		$feat=$_REQUEST['feat'];
		$artname=$_REQUEST['artist'];
		$job = $_REQUEST['role'];
		$tel = $_REQUEST['phone'];
		$release = $_REQUEST['Release'];
		if(!file_exists("{$ROOT}{$DS}assets{$DS}uploads{$DS}songs{$DS}$artname")){
			mkdir("{$ROOT}{$DS}assets{$DS}uploads{$DS}songs{$DS}$artname");
		}
		$targetmusic = "{$ROOT}{$DS}assets{$DS}ploads{$DS}songs{$DS}$artname{$DS}";
		$file = $targetmusic.basename($_FILES['music']['name']);
		$ext = strtolower(pathinfo($file,PATHINFO_EXTENSION));
		
		if(!file_exists("{$ROOT}{$DS}assets{$DS}uploads{$DS}images{$DS}artcovers{$DS}$artname")){
		mkdir("{$ROOT}{$DS}assets{$DS}uploads{$DS}images{$DS}artcovers{$DS}$artname");
		}
		$targetartboard = "{$ROOT}{$DS}assets{$DS}uploads{$DS}images{$DS}artcovers{$DS}$artname{$DS}";
		$pic = $targetartboard.basename($_FILES['pic']['name']);
		$ext2 = strtolower(pathinfo($pic,PATHINFO_EXTENSION));
		$image = $bdd->quote($pic);
		$song = $bdd->quote($file);
		
		$ins="INSERT INTO `music` (`name`, `type`, `lang`, `song`, `cover`, `artist`, `feat`, `rdate`, `ID`) VALUES ($title, $type, $lang, $song, $image, $artname, $feat, $release, NULL)";
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
		$bdd->exec($ins);
		if (move_uploaded_file($_FILES['music']['tmp_name'],$file) && move_uploaded_file($_FILES['pic']['tmp_name'],$pic)) {
			echo('<div class="m-4 alert alert-success" role="alert">
			The file '. htmlspecialchars( basename( $_FILES["music"]["name"])). ' has been uploaded.
			</div>
			<a href="../index.php" class=" m-4 btn btn-success">Back To Home page</a>
			');    
		} else {
			echo('<div class="m-4 alert alert-danger" role="alert">
			Error uploading Your File ! 
			</div>
			<a href="../index.php" class=" m-4 btn btn-warning">Back To Home page</a>
			');    
		}
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




