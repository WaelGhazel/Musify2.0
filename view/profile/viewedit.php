<?php
if(empty($_SESSION['id'])){
    header("location:index.php?controller=login");
}
else if($_REQUEST['ref']!=$_SESSION['id']){
    header("location:index.php?controller=profile&action=e&ref=".$_SESSION["id"]);
}
require_once("{$ROOT}{$DS}..{$DS}model{$DS}modelUser.php");
$u = new ModelUser;
$edit = $u->selectuser(ModelUser::$pdo->quote($_REQUEST['ref']))->fetchObject();
echo ('   
<img src="' . $edit->coverpic . '" class="img-fluid" style="height:580px ;width:100%;object-fit: cover;filter: brightness(30%);" alt="...">
<img src="' . $edit->profilepic . '" class="rounded-circle rounded mx-auto d-block" style="backdrop-filter: blur(10px);z-index:9999;width:180px;height:180px;margin-top:-60px"alt="...">
<div class="container mb-3">
<H1 class="mt-4 row justify-content-md-center">
    ' . $edit->Fname . " " . $edit->Lname . '
</H1>
<H6 class="mt-1 row justify-content-md-center">
    ' . "@" . $edit->Username . '
</H6>
</div>');
?>
<form class="container row m-3" action="index.php?controller=profile&action=s&ref=<?= $_SESSION['id'] ?>" method="POST" enctype="multipart/form-data">
    <error class="text-danger" id="ghalta">
    </error>
    <div class="col-md-6">
        <label for="inputName" class="form-label">First Name</label>
        <input type="text" class="form-control" id="inputName" name="Fname" value="<?= $edit->Fname; ?>" placeholder="John" required>
    </div>
    <div class="col-md-6">
        <label for="inputPrename" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="inputPreName" placeholder="Smith" value="<?= $edit->Lname; ?>" name="Lname" required>
    </div>
    <div class="col-12">
        <label for="user" class="form-label">Username</label>
        <input type="text" class="form-control" id="user" placeholder="john_smith" value="<?= $edit->Username; ?>" name="Uname" required readonly>
    </div>
    <div class="col-12">
        <label for="inputEmail4" class="form-label">Email</label>
        <input type="email" class="form-control" id="inputEmail4" name="email" value="<?= $edit->email; ?>" placeholder="john123@xyz.com" required>
    </div>
    <div class="row">
        <error class="text-danger" id="ghalta">
        </error>

        <div class="col-12">
            <label for="inputPassword4" class="form-label">Change Password</label>
            <input type="password" class="form-control" id="inputPassword4" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,15}" title="at least 1 number , 1 uppercase , 1 lowercase . Length[8.15]  ">
            <p class="text-secondary">leave blank for No changes</p>
        </div>
        <div class="col-12">
            <label for="inputPassword5" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="inputPassword5">
        </div>
    </div>
    <div class="col-md-6">
        <label for="artist" class="form-label">Artist Name</label>
        <input type="text" class="form-control" id="artist" name="artist" value="<?= $edit->artname; ?>" placeholder="Jony">
    </div>
    <div class="col-md-6">
        <label for="artisttype" class="form-label">Are You a ?</label>
        <select id="artisttype" class="form-select" name="role" value="<?= $edit->job; ?>" required>
            <option>Music Producer</option>
            <option>Singer</option>
            <option>Songwriter</option>
            <option>Instrument Player</option>
        </select>
    </div>

    <div class="col-md-6">
        <label for="inputPhone" class="form-label">Phone Number</label>
        <input type="tel" class="form-control" name="phone" id="inputPhone" value="<?= $edit->tel; ?>" placeholder="23456789">
    </div>
    <div class="col-md-3">
        <label for="inputSex" class="form-label">Sex</label>
        <select id="inputSex" name="sex" class="form-select" value="<?= $edit->sex; ?>" required>
            <option>Male</option>
            <option>Female</option>
            <option>Others</option>
        </select>
    </div>
    <div class="col-md-3">
        <label for="inputDate" class="form-label">Birth Date</label>
        <input type="date" name="birth" class="form-control" id="inputDate" value="<?= $edit->birth; ?>" max="2021-01-01" required>
    </div>
    <div class="col-md-6">
        <div class="mt-3 img-thumbnail">
            <img class="img-thumbnail" src="<?= $edit->coverpic; ?>" alt="">
        </div>
        <label for="inputDate" class="form-label">Cover Picture</label>
        <input type="file" name="pc" class="form-control" id="inputDate" value="<?= $edit->coverpic; ?>">
    </div>
    <div class="col-md-6">
        <div class="mt-3 img-thumbnail">
            <img class="img-thumbnail" src="<?= $edit->profilepic; ?>" alt="">
        </div>
        <label for="inputDate" class="form-label">Profile Picture</label>
        <input type="file" name="pp" class="form-control" id="inputDate" value="<?= $edit->profilepic; ?>">
    </div>
    <button type="submit" class="mt-3 submit btn btn-dark">Update Profile</button>
    <p class="mt-5 mb-3 text-muted">&copy; Musify 2021</p>
</form>