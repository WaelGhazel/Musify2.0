<?php
require_once("{$ROOT}{$DS}..{$DS}model{$DS}modelOffer.php");
require_once("{$ROOT}{$DS}..{$DS}model{$DS}modelUser.php");
$u = new ModelOffer;
$m = new ModelUser;
$offers = $u->selectOffers(ModelOffer::$pdo->quote($_REQUEST['ref']))->fetchAll();
echo ('<div class="container row-fluid mt-3">
');
foreach ($offers as $line) {
  echo ('<div class="card mt-2 mb-3">
<div class="card-header">
' . $line["sender"] . '
</div>
<div class="card-body">
<blockquote class="blockquote mb-0">
<h3 class="mb-2">' . $line["title"] . '</h3>
<h5>' . $line["content"] . '</h5>
<small><br></small>
<footer class="blockquote-footer"><small>To <cite title="Source Title">' . $line["reciever"] . '</cite></small></footer>
</blockquote>
');
  echo('
<a href="index.php?controller=profile&action=c&ref=' . $line["sender"] . '" class="mt-3 btn btn-success">Reply</a>');
echo('
</div>
</div>');
}
echo ('</div>');
?>
