<?php
require_once("{$ROOT}{$DS}..{$DS}model{$DS}modelAdmin.php");
require_once("{$ROOT}{$DS}..{$DS}model{$DS}modelArtist.php");
require_once("{$ROOT}{$DS}..{$DS}model{$DS}modelGigs.php");
require_once("{$ROOT}{$DS}..{$DS}model{$DS}modelMusic.php");
require_once("{$ROOT}{$DS}..{$DS}model{$DS}modelUser.php");
require_once("{$ROOT}{$DS}..{$DS}model{$DS}modelOffer.php");

$a = new ModelAdmin;
$b = new ModelArtist;
$c = new ModelGigs;
$d = new ModelMusic;
$e = new ModelUser;
$f = new ModelOffer;

$answerartists = $b->getAll();
$answeroffer = $f->getAll();
$answergig = $c->getAll();
$answermusic = $d->getAll();
$us = $e->getAll();
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
    <hr class="mt-4 mb-4 container col-11">
    <h1 class="mx-4">Users :</h1>
    <div class="row d-flex justify-content-evenly">
        <table class="col-11 table">
            <thead>
                <tr>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">UserName</th>
                    <th scope="col">mail</th>
                    <th scope="col">artist</th>
                    <th scope="col">Role</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Sex</th>
                    <th scope="col">Birth</th>
                    <th scope="col">Admin</th>
                    <th scope="col">Profile</th>
                    <th scope="col">Cover</th>


                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($us as $line) {
                    echo ('<tr>
      <td>' . $line['Fname'] . '</td>
      <td>' . $line['Lname'] . '</td>
      <th scope="row">' . $line['Username'] . '</th>
      <td>' . $line['email'] . '</td>
      <td>' . $line['artname'] . '</td>
      <td>' . $line['job'] . '</td>
      <td>' . $line['tel'] . '</td>
      <td>' . $line['sex'] . '</td>
      <td>' . $line['birth'] . '</td>
      <td>');
                    if ($line['Admin'] == 1) {
                        echo ('<i class="text-success fas fa-crown"></i>');
                    } else {
                        echo ('<i class="text-secondary fas fa-crown"></i>');
                    }

                    echo ('</td>
                    <td><img src="' . $line['profilepic'] . '" alt="profile" style="object-fit: contain;" class="rounded-circle" width="50" height="50"></td>
                    <td><img src="' . $line['coverpic'] . '" alt="profile" class="rounded-circle" style="object-fit: contain;" width="50" height="50"></td>
                  </tr>');
                }
                ?>
            </tbody>
        </table>

    </div>
    <hr class="mt-4 mb-4 container col-11">
    <h1 class="mx-4">Artists :</h1>
    <div class="row d-flex justify-content-evenly">
        <table class="col-11 table">
            <thead>
                <tr>
                    <th scope="col">username</th>
                    <th scope="col">artname</th>
                    <th scope="col">role</th>
                    <th scope="col">description</th>
                    <th scope="col">profilepic</th>


                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($answerartists as $line) {
                    echo ('<tr>
      <th scope="row">' . $line['username'] . '</th>
      <td>' . $line['artname'] . '</td>
      <td>' . $line['role'] . '</td>
      <td>' . $line['description'] . '</td>
      <td><img src="' . $line['profilepic'] . '" alt="profile" style="object-fit: contain;" class="rounded-circle" width="50" height="50"></td>
      </tr>');
                }
                ?>
            </tbody>
        </table>

    </div>
    <hr class="mt-4 mb-4 container col-11">
    <h1 class="mx-4">Music :</h1>
    <div class="row d-flex justify-content-evenly">
        <table class="col-11 table">
            <thead>
                <tr>
                    <th scope="col">name</th>
                    <th scope="col">type</th>
                    <th scope="col">lang</th>
                    <th scope="col">song</th>
                    <th scope="col">cover</th>
                    <th scope="col">artist</th>
                    <th scope="col">feat</th>
                    <th scope="col">rdate</th>
                    <th scope="col">ID</th>


                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($answermusic as $line) {
                    echo ('<tr>
      <td>' . $line['name'] . '</td>
      <td>' . $line['type'] . '</td>
      <td>' . $line['lang'] . '</td>
      <td> <audio src="' . $line['song'] . '"></audio></td>
      <td><img src="' . $line['cover'] . '" alt="profile" style="object-fit: contain;" class="rounded-circle" width="50" height="50"></td>
      <td>' . $line['artist'] . '</td>
      <td>' . $line['feat'] . '</td>
      <td>' . $line['rdate'] . '</td>
      <th scope="row">' . $line['ID'] . '</th>
                  ');
                }
                ?>
            </tbody>
        </table>

    </div>
    <hr class="mt-4 mb-4 container col-11">
    <h1 class="mx-4">Gigs :</h1>
    <div class="row d-flex justify-content-evenly">
        <table class="col-11 table">
            <thead>
                <tr>
                    <th scope="col">username</th>
                    <th scope="col">title</th>
                    <th scope="col">description</th>
                    <th scope="col">post</th>
                    <th scope="col">ID</th>


                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($answergig as $line) {
                    echo ('<tr>
      <td>' . $line['username'] . '</td>
      <td>' . $line['title'] . '</td>
      <td>' . $line['description'] . '</td>
      <td>' . $line['post'] . '</td>
      <th scope="row">' . $line['ID'] . '</th>
                  </tr>');
                }
                ?>
            </tbody>
        </table>

    </div>
    <hr class="mt-4 mb-4 container col-11">
    <h1 class="mx-4">Offers :</h1>
    <div class="row d-flex justify-content-evenly">
        <table class="col-11 table">
            <thead>
                <tr>
                    <th scope="col">sender</th>
                    <th scope="col">reciever</th>
                    <th scope="col">title</th>
                    <th scope="col">content</th>
                    <th scope="col">ID</th>


                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($answeroffer as $line) {
                    echo ('<tr>
      <td>' . $line['sender'] . '</td>
      <td>' . $line['reciever'] . '</td>
      <td>' . $line['title'] . '</td>
      <td>' . $line['content'] . '</td>
      <th scope="row">' . $line['ID'] . '</th>
                  </tr>');
                }
                ?>
            </tbody>
        </table>

    </div>
    <hr class="mt-4 mb-4 container col-11">


</div>

</div>


</div>

</div>



</div>