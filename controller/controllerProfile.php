<?php

$controller = 'profile';

session_start();

require_once("{$ROOT}{$DS}model{$DS}modelUser.php");


if (isset($_REQUEST['action']))
    /* recupère l'action passée dans l'URL*/
    $action = $_REQUEST['action'];
/* NB: On a ajouté un comportement par défaut avec action=readAll.*/
else $action = "a";

switch ($action) {
    case "a":
        $pagetitle = "artist";
        $view = "artist";
        require("{$ROOT}{$DS}view{$DS}view.php");
        break;
    case "u":
        $pagetitle = "User";
        $view = "user";
        require("{$ROOT}{$DS}view{$DS}view.php");
        break;
    case "e":
        $pagetitle = "Edit";
        $view = "edit";
        require("{$ROOT}{$DS}view{$DS}view.php");
        break;
    case "s":
        if (empty($_SESSION['id'])) {
            echo "<script>window.location.href='Login.php';</script>";
            exit;
        }
        require("{$ROOT}{$DS}view{$DS}navbar.php");
        echo ('    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
        <link rel="icon" href="assets/images/logo.png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
        <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
        </script>
        <!-- Bootstrap core JavaScript-->
        <script src="assets/vendor/jquery/jquery.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/script.js"></script>
        ');
        $fname = ModelUser::$pdo->quote($_REQUEST['Fname']);
        $lname = ModelUser::$pdo->quote($_REQUEST['Lname']);
        $id = $_REQUEST['Uname'];
        $uname = ModelUser::$pdo->quote($_REQUEST['Uname']);
        $email = ModelUser::$pdo->quote($_REQUEST['email']);
        $artname = ModelUser::$pdo->quote($_REQUEST['artist']);
        $role = ModelUser::$pdo->quote($_REQUEST['role']);
        $phone = ModelUser::$pdo->quote($_REQUEST['phone']);
        $sex = ModelUser::$pdo->quote($_REQUEST['sex']);
        $birth = ModelUser::$pdo->quote($_REQUEST['birth']);
        if (isset($_REQUEST['password']) && !empty($_REQUEST['password'])) {
            $password = ModelUser::$pdo->quote(password_hash($_REQUEST['password'], PASSWORD_DEFAULT));
            ModelUser::updatePassword($password, $_SESSION['id']);
        }

        if (!file_exists("assets/uploads/images/Profile/$uname")) {
            mkdir("assets/uploads/images/Profile/$uname");
        }
        if (!file_exists("assets/uploads/images/Profile/$uname/profile")) {
            mkdir("assets/uploads/images/Profile/$uname/profile");
        }
        if (!file_exists("assets/uploads/images/Profile/$uname/cover")) {
            mkdir("assets/uploads/images/Profile/$uname/cover");
        }
        $targetprofile = "assets/uploads/images/Profile/$uname/profile/";
        $pp = $targetprofile . basename($_FILES['pp']['name']);
        $ext = strtolower(pathinfo($pp, PATHINFO_EXTENSION));

        $targetcover = "assets/uploads/images/Profile/$uname/cover/";
        $pc = $targetcover . basename($_FILES['pc']['name']);
        $ext2 = strtolower(pathinfo($pc, PATHINFO_EXTENSION));
        $cover = ModelUser::$pdo->quote($pc);
        $profile = ModelUser::$pdo->quote($pp);
        ModelUser::updateProfileData($fname, $lname, $uname, $email, $artname, $role, $phone, $sex, $birth);
        if (isset($_FILES['pp']) && $_FILES['pp']['error'] != UPLOAD_ERR_NO_FILE) {
            $o = ModelUser::updateProfilePic($profile, $ext, $uname, $pp, $_FILES["pp"]["size"], $_FILES['pp']['tmp_name']);
            switch ($o) {
                case -1:
                    die('<div class="m-4 alert alert-danger" role="alert">
                    ProfilePic JPG/JPEG or PNG Only !
                    </div>
                    <a href="index.php?controller=profile&action=e&ref=' . $_SESSION['id'] . '" class=" m-4 btn btn-danger">Back To Upload page</a>
                    <br>
                    ');
                    break;
                case -2:
                    die('<div class="m-4 alert alert-danger" role="alert">
                    ProfilePic Too Large !
                    </div>
                    <a href="index.php?controller=profile&action=e&ref=' . $_SESSION['id'] . '" class=" m-4 btn btn-danger">Back To Upload page</a>
                    <br>
                    ');
                    break;
                case -3:
                    die('<div class="m-4 alert alert-danger" role="alert">
                    Error Uploading ProfilePic !
                    </div>
                    <a href="index.php?controller=profile&action=e&ref=' . $_SESSION['id'] . '" class=" m-4 btn btn-danger">Back To Upload page</a>
                    <br>
                    ');
                    break;
            }
        }
        if (isset($_FILES['pc']) && $_FILES['pc']['error'] != UPLOAD_ERR_NO_FILE) {
            $q = ModelUser::updateCoverPic($cover, $ext2, $uname, $pc, $_FILES["pc"]["size"], $_FILES['pc']['tmp_name']);
            switch ($q) {
                case -1:
                    die('<div class="m-4 alert alert-danger" role="alert">
                    Cover Picture JPG/JPEG or PNG Only !
                    </div>
                    <a href="index.php?controller=profile&action=e&ref=' . $_SESSION['id'] . '" class=" m-4 btn btn-danger">Back To Upload page</a>
                    <br>
                    ');
                    break;
                case -2:
                    die('<div class="m-4 alert alert-danger" role="alert">
                    Cover Picture Too Large !
                    </div>
                    <a href="index.php?controller=profile&action=e&ref=' . $_SESSION['id'] . '" class=" m-4 btn btn-danger">Back To Upload page</a>
                    <br>
                    ');
                    break;
                case -3:
                    die('<div class="m-4 alert alert-danger" role="alert">
                    Error Uploading Cover Picture !
                    </div>
                    <a href="index.php?controller=profile&action=e&ref=' . $_SESSION['id'] . '" class=" m-4 btn btn-danger">Back To Upload page</a>
                    <br>
                    ');
                    break;
            }
        }
        if ($o == 0 && $q == 0) {
            header("location:index.php?controller=profile&action=u&ref=" . $_SESSION['id']);
        }

        break;
    case "c":
        $pagetitle = "Contact";
        $view = "contact";
        require("{$ROOT}{$DS}view{$DS}view.php");
        break;
    case "x":
        require("{$ROOT}{$DS}model{$DS}modelOffer.php");
        $sender=ModelOffer::$pdo->quote($_SESSION['id']);
        $reciver=ModelOffer::$pdo->quote($_REQUEST['ref']);
        $title=ModelOffer::$pdo->quote($_REQUEST['title']);
        $desc=ModelOffer::$pdo->quote($_REQUEST['desc']);
        $id=ModelOffer::$pdo->quote($_SESSION['id'].$_REQUEST['title'].$_REQUEST['ref']);
        ModelOffer::insertOffer($sender, $reciver, $title, $desc, $id);
        header("location:index.php?controller=profile&action=u&ref=" . $_SESSION['id']);
        break;
    case "d":
        require("{$ROOT}{$DS}model{$DS}modelGigs.php");
        $gig=ModelGigs::$pdo->quote($_REQUEST['ref']);
        ModelGigs::deleteGig($gig);
        header("location:index.php?controller=profile&action=u&ref=" . $_SESSION['id']);
        break;
    case "m":
        require("{$ROOT}{$DS}model{$DS}modelMusic.php");
        $music=ModelMusic::$pdo->quote($_REQUEST['ref']);
        ModelMusic::deleteMusic($music);
        header("location:index.php?controller=profile&action=u&ref=" . $_SESSION['id']);
        break;

}
