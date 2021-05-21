<div class="row card mt-2 mb-2">
    <h2 class="mt-2 d-flex justify-content-around">Post Your Offer</h2>
<form action="index.php?controller=profile&action=x&ref=<?=$_REQUEST["ref"]?>" method="POST">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Title</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="title" placeholder="Offer">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" name="desc" rows="3"></textarea>
    </div>
    <button type="submit" class="mt-1 submit btn btn-dark">Send Offer</button>
    <p class="mt-1 mb-3 text-muted">&copy; Musify 2021</p>
</form>
</div>