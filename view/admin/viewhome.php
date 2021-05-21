<?php
require_once("{$ROOT}{$DS}..{$DS}model{$DS}modelArtist.php");
require_once("{$ROOT}{$DS}..{$DS}model{$DS}modelGigs.php");
require_once("{$ROOT}{$DS}..{$DS}model{$DS}modelMusic.php");
require_once("{$ROOT}{$DS}..{$DS}model{$DS}modelOffer.php");
require_once("{$ROOT}{$DS}..{$DS}model{$DS}modelUser.php");
$a = new ModelArtist;
$b = new ModelGigs;
$c = new ModelMusic;
$d = new ModelOffer;
$e = new ModelUser;
$answerartists = ModelArtist::getAll();
$answermusic = ModelMusic::getAll();
$answergig = ModelGigs::getAll();
$male = ModelUser::selectSex(ModelUser::$pdo->quote("Male"))->rowCount();
$female = ModelUser::selectSex(ModelUser::$pdo->quote("Female"))->rowCount();
$others = ModelUser::selectSex(ModelUser::$pdo->quote("Other"))->rowCount();
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
        <li class="breadcrumb-item"><a href="../index.php">Musify</a></li>
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
                                Atists (Total)</div>
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



    <!-- Content Row -->
    <div class="row">

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Users Genders</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Male
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-danger"></i> Female
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-warning"></i> Others
                        </span>

                    </div>
                </div>
            </div>
        </div>
        <!-- Project Card Example -->
        <div class="card shadow mb-4 col-xl-8 col-lg-7">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Artist Types</h6>
            </div>
            <div class="card-body">
                <h4 class="small font-weight-bold">Music Producers <span class="float-right"><?= ($producer / $total) * 100 ?>%</span>
                </h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width:<?= ($producer / $total) * 100 ?>%;" aria-valuenow="<?= ($producer / $total) * 100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Singers <span class="float-right"><?= ($singer / $total) * 100 ?>%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: <?= ($singer / $total) * 100 ?>%" aria-valuenow="<?= ($singer / $total) * 100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Song Writers <span class="float-right"><?= ($writer / $total) * 100 ?>%</span>
                </h4>
                <div class="progress mb-4">
                    <div class="progress-bar" role="progressbar" style="width: <?= ($writer / $total) * 100 ?>%" aria-valuenow="<?= ($writer / $total) * 100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Instrument Players <span class="float-right"><?= ($player / $total) * 100 ?>%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-info" role="progressbar" style="width: <?= ($player / $total) * 100 ?>%" aria-valuenow="<?= ($player / $total) * 100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>

    </div>


</div>



<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
