<div class="pagename">
    <H1 class="welcome"> <br><br>Login</H1>
</div>
<form class="container row m-3" method="POST" action="index.php?controller=login&action=created">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../index.php">Musify</a></li>
            <li class="breadcrumb-item active" aria-current="page">Login</li>
        </ol>
    </nav>
    <h1 class="h3 mb-3 fw-normal">Please login</h1>
    <label for="inputEmail" class="visually-hidden">Username</label>
    <input type="text" name="username" id="inputEmail" class="form-control mb-3" placeholder="Username" required autofocus>
    <label for="inputPassword" class="visually-hidden">Password</label>
    <input type="password" name="password" id="inputPassword" class="form-control mb-3" placeholder="Password" required>
    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
    </div>
    <div class="col-4">
        <button class="w-100 btn btn-dark" type="submit">Log in</button>
    </div>
    <p class="text-secondary mt-2">Not a member ? <a href="index.php?controller=login&action=register" class="link-primary">Register Here</a></p>
    <p class="mt-5 mb-3 text-muted">&copy; Musify 2021</p>
</form>
