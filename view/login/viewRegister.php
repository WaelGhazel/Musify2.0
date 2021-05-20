<div class="pagename">
    <H1 class="welcome"> <br><br>Register</H1>
</div>
<form class="container row m-3" action="index.php?controller=login&action=regist" method="POST">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../index.html">Musify</a></li>
            <li class="breadcrumb-item active" aria-current="page">Register</li>
        </ol>
    </nav>
    <error class="text-danger" id="ghalta">
    </error>
    <div class="col-md-6">
        <label for="inputName" class="form-label">First Name</label>
        <input type="text" class="form-control" id="inputName" name="Fname" placeholder="John" required>
    </div>
    <div class="col-md-6">
        <label for="inputPrename" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="inputPreName" placeholder="Smith" name="Lname" required>
    </div>
    <div class="col-12">
        <label for="user" class="form-label">Username</label>
        <input type="text" class="form-control" id="user" placeholder="john_smith" name="Uname" required>
    </div>
    <div class="col-12">
        <label for="inputEmail4" class="form-label">Email</label>
        <input type="email" class="form-control" id="inputEmail4" name="email" placeholder="john123@xyz.com" required>
    </div>
    <div class="col-12">
        <label for="inputPassword4" class="form-label">Password</label>
        <input type="password" class="form-control" id="inputPassword4" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,15}" title="at least 1 number , 1 uppercase , 1 lowercase . Length[8.15]  " required>
    </div>
    <div class="col-12">
        <label for="inputPassword5" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="inputPassword5" required>
    </div>
    <div class="col-md-6">
        <label for="artist" class="form-label">Artist Name</label>
        <input type="text" class="form-control" id="artist" name="artist" placeholder="Jony">
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

    <div class="col-md-6">
        <label for="inputPhone" class="form-label">Phone Number</label>
        <input type="tel" class="form-control" name="phone" id="inputPhone" placeholder="23456789">
    </div>
    <div class="col-md-3">
        <label for="inputSex" class="form-label">Sex</label>
        <select id="inputSex" name="sex" class="form-select" required>
            <option selected>Choose...</option>
            <option>Male</option>
            <option>Female</option>
            <option>Others</option>
        </select>
    </div>
    <div class="col-md-3">
        <label for="inputDate" class="form-label">Birth Date</label>
        <input type="date" name="birth" class="form-control" id="inputDate" max="2021-01-01" required>
    </div>
    <div class="col-12">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck" required>
            <label class="form-check-label" for="gridCheck">
                I agree to the terms and conditions
            </label>
        </div>
    </div>
    <button type="submit" class="submit btn btn-dark">Create Account</button>
    <p class="text-secondary mt-2">already a member ? <a href="index.php?controller=login" class="link-primary">Login Here</a></p>
    <p class="mt-5 mb-3 text-muted">&copy; Musify 2021</p>
</form>