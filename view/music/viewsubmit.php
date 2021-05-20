<div class="pagename">
        <H1 class="welcome"> <br><br>Submit</H1>
</div>
<nav class="container" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="../index.php?controller=home">Musify</a></li>
      <li class="breadcrumb-item active" aria-current="page">Submit</li>
    </ol>
</nav>                
<nav class="container mt-2 mb-4 nav nav-justified d-flex justify-content-around">
  <a class="mx-2 nav-item nav-link btn btn-outline-dark" href="index.php?controller=music&action=home">Home</a>
  <a class="mx-2 nav-item nav-link btn btn-outline-dark" href="index.php?controller=music&action=gigs">Gigs</a>
  <a class="mx-2 nav-item nav-link btn btn-outline-dark" href="index.php?controller=music&action=music">Music</a>
  <a class="mx-2 nav-item nav-link btn btn-dark active" href="index.php?controller=music&action=submit">Submit </a>
</nav>
<form class="container row m-3 " method="POST" action="../index.php?controller=home&action=submitted" enctype="multipart/form-data">
                    <div class="col-md-6">
                        <label for="inputName" class="form-label">Track Title</label>
                        <input type="text" class="form-control" id="inputName" name="Title" placeholder="Title ..." required>
                    </div>
                    <div class="col-md-6">
                        <label for="inputPrename" class="form-label">Type</label>
                        <input type="text" class="form-control" id="inputPreName" placeholder="Cover/Remix ..." name="Type" required>
                    </div>
                    <div class="col-12">
                        <label for="user" class="form-label">Language</label>
                        <input type="text" class="form-control" id="user" placeholder="English" name="Lang" required>
                    </div>
                    <div class="col-12">
                        <label for="inputEmail4" class="form-label">Song</label>
                        <input type="file" class="form-control" id="inputEmail4" name="music" required>
                    </div>
                    <div class="col-12">
                        <label for="inputPassword4" class="form-label">CoverArt</label>
                        <input type="File" class="form-control" id="inputPassword4" name="pic" required>
                    </div>
                    <div class="col-12">
                        <label for="inputPassword5" class="form-label">Featured Artists</label>
                        <input type="text" class="form-control" name="feat" id="inputPassword5" placeholder="WG">
                    </div>
                    <div class="col-md-6">
                        <label for="artist" class="form-label">Artist Name</label>
                        <input type="text" class="form-control" id="artist" name="artist"
                            placeholder="Jony" required>
                    </div>
                    <div class="col-md-6">
                        <label for="artisttype" class="form-label">Are You a ?</label>
                        <select id="artisttype" class="form-select" name="role" required>
                            <option selected>Choose...</option>
                            <option>Music Producer</option>
                            <option>Singer</option>
                            <option>Songwriter</option>
                            <option>Instrument Player</option>
                        </select>
                    </div>

                    <div class="col-md-9">
                        <label for="inputPhone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" name="phone" id="inputPhone" placeholder="23456789">
                    </div>
                    <div class="col-md-3">
                        <label for="inputDate" class="form-label">Release Date</label>
                        <input type="date" name="Release" class="form-control" id="inputDate" min="2021-01-01" required>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck" required>
                            <label class="form-check-label" for="gridCheck">
                                I agree to the terms and conditions
                            </label>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="w-100 btn btn-dark">Upload Track</button>
                    <p class="mt-5 mb-3 text-muted">&copy; Musify 2021</p>
    </form>