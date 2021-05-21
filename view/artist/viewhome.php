<div class="pagename">
  <H1 class="welcome"> <br><br>Artists</H1>
</div>
<nav class="container" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="../index.php?controller=home">Musify</a></li>
    <li class="breadcrumb-item active" aria-current="page">Artists</li>
  </ol>
</nav>
<nav class="navbar container navbar-light">
    <div class="col mx-4">
        <form class="d-flex" action="index.php?controller=artist&action=search" method="POST">
            <input class="form-control me-2" type="search" placeholder="Search For Artist" name="search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>
</nav>

<?php

require_once("{$ROOT}{$DS}..{$DS}model{$DS}modelArtist.php");
$x = new ModelArtist;
$tab = $x->getAll()->fetchAll();


echo ('    <div class="container">
    <div class="d-flex row-fluid ">');

foreach ($tab as $line) {
    echo ('<div class="col-sm-3 m-3">
        <div class="card-columns-fluid">
        <div class="card" style="width: 18rem;">
            <img src="' . $line["profilepic"] . '" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">' . $line["artname"] . '</h5>
                <p class="card-text">' . $line["description"] . '</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">' . $line["username"] . '</li>
                <li class="list-group-item">' . $line["role"] . '</li>
            </ul>
            <div class="card-body">
                <a href="http://localhost/Musify-site/' . $line["username"] . '/artist" class="btn btn-dark">Profile</a>
            </div>
        </div>
        </div>
        </div>');
}
echo ('
    </div>
</div>
');
