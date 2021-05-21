<?php
if(empty($_SESSION['id'])){
    header("location:index.php?controller=login");
}

require_once("{$ROOT}{$DS}..{$DS}model{$DS}modelUser.php");
$u = new ModelUser;
$profile = $u->selectuser(ModelUser::$pdo->quote($_REQUEST['ref']))->fetchObject();
echo ('   
<img src="' . $profile->coverpic . '" class="img-fluid" style="height:580px ;width:100%;object-fit: cover;filter: brightness(30%);" alt="...">
<img src="' . $profile->profilepic . '" class="rounded-circle rounded mx-auto d-block" style="backdrop-filter: blur(10px);z-index:9999;width:180px;height:180px;margin-top:-60px"alt="...">
<div class="container mb-3">
<H1 class="mt-4 row justify-content-md-center">
    ' . $profile->Fname . " " . $profile->Lname . '
</H1>
<H6 class="mt-1 row justify-content-md-center">
    ' . "@" . $profile->Username . '
</H6>
</div>');
if($_REQUEST['ref']!=$_SESSION['id']){
    echo('<div class="container">');
    include("form.php");
    echo('</div>');
}
elseif($_REQUEST['ref']==$_SESSION['id']){
    echo('<div class="container">');
    include("offers.php");
    echo('</div>');
}

/*if($_REQUEST['ref']!=$_SESSION['id']){
    header("location:index.php?controller=profile&action=e&ref=".$_SESSION["id"]);
}*/

