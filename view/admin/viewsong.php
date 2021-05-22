<?php
require_once("{$ROOT}{$DS}..{$DS}model{$DS}modelAdmin.php");
require_once("{$ROOT}{$DS}..{$DS}model{$DS}modelArtist.php");
require_once("{$ROOT}{$DS}..{$DS}model{$DS}modelGigs.php");
require_once("{$ROOT}{$DS}..{$DS}model{$DS}modelMusic.php");
require_once("{$ROOT}{$DS}..{$DS}model{$DS}modelUser.php");
$a = new ModelAdmin;
$b = new ModelArtist;
$c = new ModelGigs;
$d = new ModelMusic;
$e = new ModelUser;
$answerartists = $b->getAll();
$answergig = $c->getAll();
$answermusic = $d->getAll();
if ($answermusic->rowCount() == 0) {
    $per = -1;
} else {
    $per = ($answerartists->rowCount() / $answermusic->rowCount()) * 100;
}
$precent = number_format((float)$per, 1, '.', '');
$prec = $precent . '%';

?>

<nav class="container row m-3" aria-label="breadcrumb">
    <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item"><a href="index.php?controller=home">Musify</a></li>
        <li class="breadcrumb-item active" aria-current="page">AdminPage</li>
    </ol>
</nav>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <form action="index.php?controller=admin&action=update" method="POST">
            <button class="d-none d-sm-inline-block btn btn-primary shadow-sm" type="submit"> <i class="fas fa-download fa-sm text-white-50"></i> Update DB</button>
        </form>

    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Artists (Total)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo ($answerartists->rowCount()); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Gigs (Total)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo ($answergig->rowCount()); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-guitar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Artists Per
                                Songs
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        <?php echo ($precent); ?>%
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $prec; ?>" aria-valuenow="<?= $precent ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Music (Total)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo ($answermusic->rowCount()); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-music fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
        $i = 0;
        $mus = $u->selectMusic($line['artname']);
        if ($mus->rowCount() == 0) {
            continue;
        }
        echo ('<div class="row card mb-2">');
        echo ('<img src="' . $line['profilepic'] . '" class="mt-2 rounded mx-auto d-block rounded-circle" style="height:100px;width:120px;" alt="...">
  <h2 class="d-flex justify-content-around">' . $line['artname'] . '</h2>
  <a href="index.php?controller=profile&action=a&ref=' . $line["Username"] . '" class="col-1 mx-auto d-block btn btn-outline-dark">profile</a>
  ');
        $music = $mus->fetchAll();
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
    }
    echo ('</div>');
    ?>
</div>