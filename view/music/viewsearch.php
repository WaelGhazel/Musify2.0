<div class="pagename">
    <H1 class="welcome"> <br><br>Search Results</H1>
</div>
<nav class="container" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../index.php?controller=home">Musify</a></li>
        <li class="breadcrumb-item active" aria-current="page">Search Result</li>
    </ol>
</nav>
<nav class="container mt-2 mb-4 nav nav-justified d-flex justify-content-around">
    <a class="mx-2 nav-item nav-link btn btn-outline-dark" href="index.php?controller=music&action=home">Home</a>
    <a class="mx-2 nav-item nav-link btn btn-outline-dark" href="index.php?controller=music&action=gigs">Gigs</a>
    <a class="mx-2 nav-item nav-link btn btn-outline-dark" href="index.php?controller=music&action=music">Music</a>
    <a class="mx-2 nav-item nav-link btn btn-outline-dark" href="index.php?controller=music&action=submit">Submit </a>
</nav>
<div class="container mb-2">
    <div class="row card mb-2">
        <h1 class="mx-auto d-block mt-2 text-dark">Search Results</h1>
        <?php
        require_once("model{$DS}modelMusic.php");
        $search = ModelMusic::$pdo->quote("%" . $_REQUEST['search'] . "%");
        $u = new ModelMusic();
        $res = $u->searchmusic($search);
        if ($res == -1) {
            echo ('<div class="m-4 alert alert-warning" role="alert">
        Nothing found !
        </div>
        <a href="index.php?controller=music&action=music" class=" m-4 btn btn-warning">Back To Music page</a>
        ');
        } else {
            $i = 0;
            $tab = $res->fetchAll();
            echo ('<div class="d-flex row-fluid justify-content-around mt-2 mb-1">');
            foreach ($tab as $x) {
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
            echo ('
        </div>');
        }
        ?>
    </div>
</div>