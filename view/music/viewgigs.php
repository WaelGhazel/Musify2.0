<div class="pagename">
  <H1 class="welcome"> <br><br>Gigs</H1>
</div>
<nav class="container" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="../index.php?controller=home">Musify</a></li>
    <li class="breadcrumb-item active" aria-current="page">Gigs</li>
  </ol>
</nav>
<nav class="container mt-2 mb-4 nav nav-justified d-flex justify-content-around">
  <a class="mx-2 nav-item nav-link btn btn-outline-dark" href="index.php?controller=music&action=home">Home</a>
  <a class="mx-2 nav-item nav-link btn btn-dark active" href="index.php?controller=music&action=gigs">Gigs</a>
  <a class="mx-2 nav-item nav-link btn btn-outline-dark" href="index.php?controller=music&action=music">Music</a>
  <a class="mx-2 nav-item nav-link btn btn-outline-dark" href="index.php?controller=music&action=submit">Submit </a>
</nav>
<?php
if(isset($_SESSION['id'])){
echo('
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
}
?>
<?php
require_once("{$ROOT}{$DS}..{$DS}model{$DS}modelGigs.php");
require_once("{$ROOT}{$DS}..{$DS}model{$DS}modelUser.php");
$u = new ModelGigs();
$m = new ModelUser();
$gigs = $u->selectGigs()->fetchAll();
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
if($line["username"]!=$_SESSION['id']){
  echo('
<a href="index.php?controller=profile&action=c&ref=' . $line["username"] . '" class="mt-3 btn btn-success">Contact</a>');
}
echo('
</div>
</div>');
}
echo ('</div>');

?>