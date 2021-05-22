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
$male = $e->selectSex(ModelUser::$pdo->quote("Male"))->rowCount();
$female = $e->selectSex(ModelUser::$pdo->quote("Female"))->rowCount();
$others = $e->selectSex(ModelUser::$pdo->quote("Other"))->rowCount();
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
$producer = $b->selectRole(ModelArtist::$pdo->quote("Music Producer"))->rowCount();
$singer = $b->selectRole(ModelArtist::$pdo->quote("Singer"))->rowCount();
$writer = $b->selectRole(ModelArtist::$pdo->quote("Songwriter"))->rowCount();
$player = $b->selectRole(ModelArtist::$pdo->quote("Instrument Player"))->rowCount();
$total = $b->getAll()->rowCount();
$last = $c->lastGig()->fetchObject();
$profile = $e->selectuser($e::$pdo->quote($last->username))->fetchObject();

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
                <h4 class="small font-weight-bold">Music Producers <span class="float-right"><?= round(($producer / $total) * 100, 2) ?>%</span>
                </h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width:<?= ($producer / $total) * 100 ?>%;" aria-valuenow="<?= ($producer / $total) * 100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Singers <span class="float-right"><?= round(($singer / $total) * 100, 2) ?>%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: <?= ($singer / $total) * 100 ?>%" aria-valuenow="<?= ($singer / $total) * 100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Song Writers <span class="float-right"><?= round(($writer / $total) * 100, 2) ?>%</span>
                </h4>
                <div class="progress mb-4">
                    <div class="progress-bar" role="progressbar" style="width: <?= ($writer / $total) * 100 ?>%" aria-valuenow="<?= ($writer / $total) * 100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Instrument Players <span class="float-right"><?= round(($player / $total) * 100, 2) ?>%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-info" role="progressbar" style="width: <?= ($player / $total) * 100 ?>%" aria-valuenow="<?= ($player / $total) * 100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>

    </div>
    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-6 mb-4">

            <!-- Color System -->
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card bg-primary text-white shadow">
                        <div class="card-body">
                            Primary
                            <div class="text-white-50 small">#4e73df</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-success text-white shadow">
                        <div class="card-body">
                            Success
                            <div class="text-white-50 small">#1cc88a</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-info text-white shadow">
                        <div class="card-body">
                            Info
                            <div class="text-white-50 small">#36b9cc</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-warning text-white shadow">
                        <div class="card-body">
                            Warning
                            <div class="text-white-50 small">#f6c23e</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-danger text-white shadow">
                        <div class="card-body">
                            Danger
                            <div class="text-white-50 small">#e74a3b</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-secondary text-white shadow">
                        <div class="card-body">
                            Secondary
                            <div class="text-white-50 small">#858796</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-light text-black shadow">
                        <div class="card-body">
                            Light
                            <div class="text-black-50 small">#f8f9fc</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-dark text-white shadow">
                        <div class="card-body">
                            Dark
                            <div class="text-white-50 small">#5a5c69</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-6 mb-4">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Latest Gig</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img src="<?= $profile->profilepic ?>" class="rounded-circle" alt="profile" style="height:70px;weidth:70px;">
                        <h5><?= $profile->Username; ?></h5>
                    </div>
                    <h5><?= $last->title ?></h5>
                    <p><?= $last->description ?></p>
                    <small><?php echo ($last->post); ?></small>
                    <br>
                    <a href="artistprofile.php?ref=<?= $profile->Username; ?>">Check <?= $profile->artname; ?> profile</a>
                </div>
            </div>

            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                </div>
                <div class="card-body">
                    <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce
                        CSS bloat and poor page performance. Custom CSS classes are used to create
                        custom components and custom utility classes.</p>
                    <p class="mb-0">Before working with this theme, you should become familiar with the
                        Bootstrap framework, especially the utility classes.</p>
                </div>
            </div>

        </div>
    </div>

    <!-- Page level plugins -->
    <script src="assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/JS/demo/chart-area-demo.js"></script>

    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        // Pie Chart Example
        var ctx = document.getElementById("myPieChart").getContext('2d');;
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Male", "Female", "Others"],
                datasets: [{
                    data: [<?= $male ?>, <?= $female ?>, <?= $others ?>],
                    backgroundColor: ['#4e73df', '#e74a3b', '#f6c23e'],
                    hoverBackgroundColor: ['#2e59d9', '#A1342A', '#D6A936'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });
    </script>



</div>