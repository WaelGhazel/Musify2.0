


<?php

$controller = 'music';

session_start();

require_once("{$ROOT}{$DS}model{$DS}modelMusic.php");
require_once("{$ROOT}{$DS}model{$DS}modelGigs.php");


if (isset($_REQUEST['action']))
	/* recupère l'action passée dans l'URL*/
	$action = $_REQUEST['action'];
/* NB: On a ajouté un comportement par défaut avec action=readAll.*/
else $action = "home";

switch ($action) {
	case "home":
		$pagetitle = "All";
		$view = "all";
		require("{$ROOT}{$DS}view{$DS}view.php");
		break;
	case "submit":
		$pagetitle = "Submit";
		$view = "submit";
		require("{$ROOT}{$DS}view{$DS}view.php");
		break;
	case "submitted":
		echo ('<!DOCTYPE html>
		<html >
		<head>
			<title>Musify</title>
			<!-- lien css -->
			<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
			<link rel="icon" href="assets/images/logo.png">
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
				integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
			<link href="CSS/sb-admin-2.min.css" rel="stylesheet">
			<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
			<link
				href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
				rel="stylesheet">
				<link
			  rel="stylesheet"
			  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css">
		</head>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
            </script>
    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>


		');
		require_once("{$ROOT}{$DS}view{$DS}navbar.php");
		$id = ModelMusic::$pdo->quote($_REQUEST['Title'] . $_REQUEST['artist'] . $_REQUEST['Release']);
		$title = ModelMusic::$pdo->quote($_REQUEST['Title']);
		$type = ModelMusic::$pdo->quote($_REQUEST['Type']);
		$lang = ModelMusic::$pdo->quote($_REQUEST['Lang']);
		$feat = ModelMusic::$pdo->quote($_REQUEST['feat']);
		$artname = ModelMusic::$pdo->quote($_REQUEST['artist']);
		$job = ModelMusic::$pdo->quote($_REQUEST['role']);
		$tel = ModelMusic::$pdo->quote($_REQUEST['phone']);
		$release = ModelMusic::$pdo->quote($_REQUEST['Release']);
		if (!file_exists("assets{$DS}uploads{$DS}songs{$DS}$artname")) {
			mkdir("assets{$DS}uploads{$DS}songs{$DS}$artname");
		}
		$targetmusic = "assets{$DS}uploads{$DS}songs{$DS}$artname{$DS}";
		$file = $targetmusic . basename($_FILES['music']['name']);
		$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

		if (!file_exists("assets{$DS}uploads{$DS}images{$DS}artcovers{$DS}$artname")) {
			mkdir("assets{$DS}uploads{$DS}images{$DS}artcovers{$DS}$artname");
		}
		$targetartboard = "assets{$DS}uploads{$DS}images{$DS}artcovers{$DS}$artname{$DS}";
		$pic = $targetartboard . basename($_FILES['pic']['name']);
		$ext2 = strtolower(pathinfo($pic, PATHINFO_EXTENSION));
		$image = ModelMusic::$pdo->quote($pic);
		$song = ModelMusic::$pdo->quote($file);

		if ($ext != "mp3") {
			die('<div class="m-4 alert alert-danger" role="alert">
		MP3 Only !
		</div>
		<a href="../pages/Formupload.php" class=" m-4 btn btn-danger">Back To Upload page</a>
		<br>
		');
		} else if ($_FILES["music"]["size"] > 50000000) {
			die('<div class="m-4 alert alert-danger" role="alert">
		File Too Large !
		</div>
		<a href="index.php?controller=music&action=submit" class=" m-4 btn btn-danger">Back To Upload page</a>
		');
		} else if ($ext2 != "jpg" && $ext2 != "png" && $ext2 != "jpeg") {
			die('<div class="m-4 alert alert-danger" role="alert">
		JPG/JPEG or PNG Only !
		</div>
		<a href="index.php?controller=music&action=submit" class=" m-4 btn btn-danger">Back To Upload page</a>
		<br>
		');
		} else if ($_FILES["pic"]["size"] > 10000000) {
			die('<div class="m-4 alert alert-danger" role="alert">
		File Too Large !
		</div>
		<a href="index.php?controller=music&action=submit" class=" m-4 btn btn-danger">Back To Upload page</a>
		');
		}
		$u = new ModelMusic($title, $type, $lang, $song, $image, $artname, $feat, $release, $id);
		$u->uploadsong($title, $type, $lang, $song, $image, $artname, $feat, $release, $id);
		echo ('khedmt');
		if (move_uploaded_file($_FILES['music']['tmp_name'], $file) && move_uploaded_file($_FILES['pic']['tmp_name'], $pic)) {
			echo "<script>window.location.href='index.php?controller=home';</script>";
		} else {
			echo ('<div class="m-4 alert alert-danger" role="alert">
			Error uploading Your File ! 
			</div>
			<a href="../index.php" class=" m-4 btn btn-warning">Back To Home page</a>
			');
		}
		break;
	case "gigs":
		$pagetitle = "Gigs";
		$view = "gigs";
		require("{$ROOT}{$DS}view{$DS}view.php");
		break;

	case "music":
		$pagetitle = "Music";
		$view = "music";
		require("{$ROOT}{$DS}view{$DS}view.php");
		break;
	case "search":
		$pagetitle = "Search";
		$view = "search";
		require("{$ROOT}{$DS}view{$DS}view.php");
		break;
	case "gig":
		$title = ModelGigs::$pdo->quote($_REQUEST['title']);
		$desc = ModelGigs::$pdo->quote($_REQUEST['description']);
		$uname = ModelGigs::$pdo->quote($_SESSION['id']);
		$id=ModelGigs::$pdo->quote($_REQUEST['title'].$_SESSION['id'].date("Y-m-d"));
		ModelGigs::insertgig($title,$desc,$uname,$id);
		header("location:index.php?controller=music&action=gigs");
		break;
}
?>