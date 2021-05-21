<?php
echo($_SESSION['admin']);
if (empty($_SESSION['id']) || $_SESSION['id'] != $_REQUEST['ref']) {
    header('location:index.php?controller=profile&action=a&ref=' . $_REQUEST['ref']);
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
<div class="row justify-content-md-center">
    <div class="col-md-auto">
    <a href="index.php?controller=profile&action=c&ref=' . $_SESSION['id'] . '" class="mt-4 btn btn-outline-secondary">Gigs answers</a>

        <a href="index.php?controller=profile&action=e&ref=' . $_REQUEST['ref'] . '" class="mt-4 btn btn-outline-secondary">Edit Profile</a>');
if ($profile->Admin == 1) {
    $_SESSION['admin']=1;
    echo ('
    <a href="index.php?controller=admin" class="mt-4 btn btn-outline-secondary">Admin Parameters</a>
    ');
}
echo ('
</div>
</div>
</div>
');
echo ('
<hr class="container mt-4 mb-3">
<div class="container">
  <div class="card mb-4">
    <form action="index.php?controller=music&action=gig" method="POST">
      <div class="card-body">
          <h4 class="mx-2"> Create Gig </h4>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Gig Title</label>
            <input type="Text" class="form-control" name="title" id="exampleFormControlInput1" placeholder="Your Gig Title here ..." required>
          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3" required></textarea>
          </div>
          <button class="btn btn-dark d-flex" type="submit">Submit Gig</button>
      </div>
    </form>
  </div>
</div>
<hr class="container mt-4 mb-3">
');
echo ('
<div class="mt-4 container">
    <div class="row col-md-auto">
        <div class="list-group list-group-horizontal" id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action d-flex justify-content-center btn-dark active" id="list-home-list" data-bs-toggle="list" href="#list-home" role="tab" aria-controls="home">Feed</a>
            <a class="list-group-item list-group-item-action d-flex justify-content-center btn-dark" id="list-profile-list" data-bs-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Music</a>
        </div>
    </div>
    <div class="container">
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">');
require_once("{$ROOT}{$DS}..{$DS}model{$DS}modelGigs.php");
$f = new ModelGigs;
$gigs = $f->selectUserGigs(ModelGigs::$pdo->quote($profile->Username))->fetchAll();
echo ('<div class="container row-fluid mt-3">
');
foreach ($gigs as $line) {
    echo ('<div class="card mt-2 mb-3">
<div class="card-header">
' . $line["username"] . '
</div>
<div class="card-body">
<blockquote class="blockquote mb-0">
<h3 class="mb-2">' . $line["title"] . '</h3>
<h5>' . $line["description"] . '</h5>
<small><br></small>
<footer class="blockquote-footer"><small>Uploaded <cite title="Source Title">' . $line["post"] . '</cite></small></footer>
</blockquote>
');
    if ($line["username"] != $_SESSION['id']) {
        echo ('
<a href="index.php?controller=profile&action=c&ref=' . $line["username"] . '" class="mt-3 btn btn-success">Contact</a>');
    }
    echo ('
</div>
</div>');
}
echo ('</div>');


echo ('</div>

            <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
            ');
require_once("{$ROOT}{$DS}..{$DS}model{$DS}modelMusic.php");
$u = new ModelMusic();

$mus = $u->selectMusic($profile->artname);
$music = $mus->fetchAll();
$i = 0;
echo ('<div class="d-flex row-fluid justify-content-around mt-2 mb-1">');
foreach ($music as $x) {
    $i++;
    echo ('<div class="d-flex row-fluid">
              <div class="card-columns-fluid">
              <div class="card" style="width: 21rem;background:#f1f3f4;">
            <img src="' . $x['cover'] . '" class="card-img-top" alt="cover">
            <div class="card-body">
              <h5 class="card-title">' . $x['name'] . '</h5>
              <p class="card-text text-secondary">' . $x['artist']);
    if ($x['name'] != "") {
        echo (' FT ' . $x['feat']);
    }
    echo ('</p>
              <small class="text-secondary">' . $x['rdate'] . '</small>
              <audio controls preload="auto">
              <source src="' . $x['song'] . '" type="audio/mpeg" />
              This text displays if the audio tag isn\'t supported.
          </audio>
            </div>
          </div>
          </div>
            </div>');
    if ($i % 3 == 0) {
        echo ('</div><div class="d-flex row-fluid justify-content-around mt-2 mb-1">');
    }
}
echo ('</div>');
echo ('</div>');
echo ('

            </div>
        </div>
    </div>
</div>');
