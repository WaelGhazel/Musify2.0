<div class="pagename">
  <H1 class="welcome"> <br><br>Music</H1>
</div>
<nav class="container" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="../index.php?controller=home">Musify</a></li>
    <li class="breadcrumb-item active" aria-current="page">Music</li>
  </ol>
</nav>
<nav class="container mt-2 mb-4 nav nav-justified d-flex justify-content-around">
  <a class="mx-2 nav-item nav-link btn btn-outline-dark" href="index.php?controller=music&action=home">Home</a>
  <a class="mx-2 nav-item nav-link btn btn-outline-dark" href="index.php?controller=music&action=gigs">Gigs</a>
  <a class="mx-2 nav-item nav-link btn btn-dark active" href="index.php?controller=music&action=music">Music</a>
  <a class="mx-2 nav-item nav-link btn btn-outline-dark" href="index.php?controller=music&action=submit">Submit </a>
</nav>
<nav class="navbar container navbar-light">
    <div class="col mx-4">
        <form class="d-flex" action="index.php?controller=music&action=search" method="POST">
            <input class="form-control me-2" type="search" placeholder="Search For Music" name="search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>
</nav>
<?php
require_once("{$ROOT}{$DS}..{$DS}model{$DS}modelMusic.php");
require_once("{$ROOT}{$DS}..{$DS}model{$DS}modelUser.php");
$u = new ModelMusic();
$m = new ModelUser();
$tab = $m->getAll()->fetchAll();
echo ('<div class="container mb-2">');
foreach ($tab as $line) {
  $i=0;
  $mus = $u->selectMusic($line['artname']);
  if($mus->rowCount()==0){
    continue;
  }
  echo ('<div class="row card mb-2">');
  echo ('<img src="' . $line['profilepic'] . '" class="mt-2 rounded mx-auto d-block rounded-circle" style="height:100px;width:120px;" alt="...">
  <h2 class="d-flex justify-content-around">' . $line['artname'] . '</h2>
  <a href="" class="col-1 mx-auto d-block btn btn-outline-dark">profile</a>
  ');
  $music=$mus->fetchAll();
  echo ('<div class="d-flex row-fluid justify-content-around mt-2 mb-1">');
  foreach ($music as $x) {
    $i++;
    echo ('<div class="d-flex row-fluid">
    <div class="card-columns-fluid">
    <div class="card" style="width: 21rem;background:#f1f3f4;">
  <img src="'.$x['cover'].'" class="card-img-top" alt="cover">
  <div class="card-body">
    <h5 class="card-title">'.$x['name'].'</h5>
    <p class="card-text text-secondary">'.$x['artist']);
    if($x['name']!=""){
      echo(' FT '.$x['feat']);
    }
    echo('</p>
    <small class="text-secondary">'.$x['rdate'].'</small>
    <audio controls preload="auto">
    <source src="'.$x['song'].'" type="audio/mpeg" />
    This text displays if the audio tag isn\'t supported.
</audio>
  </div>
</div>
</div>
  </div>');
  if($i%3==0){
    echo ('</div><div class="d-flex row-fluid justify-content-around mt-2 mb-1">');
  }
  }
  echo ('</div>');
  echo ('</div>');
}
echo ('</div>');
?>