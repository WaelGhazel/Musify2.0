
<?php



$controller = 'login';

session_start();






require_once("{$ROOT}{$DS}model{$DS}modelUser.php");



if (isset($_REQUEST['action']))
	/* recupère l'action passée dans l'URL*/
	$action = $_REQUEST['action'];
/* NB: On a ajouté un comportement par défaut avec action=readAll.*/
else $action = "login";

switch ($action) {


	case "created":
		include("{$ROOT}{$DS}view{$DS}navbar.php");
		if (isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
			$username = $_REQUEST['username'];
			$password = $_REQUEST['password'];


			$u = ModelUser::login($username, $password);

			if ($u == -1) {
				echo 'errrrr';
			} else {
				$ligne = $u->fetchObject();

				if ($ligne->Admin == 0) {
					$_SESSION['id'] = $username;
					$_SESSION['admin'] = 0;

					header("location: index.php?controller=home");
					exit;
				} else {
					$_SESSION['admin'] = 1;
					$_SESSION['id'] = $username;
					header("location: index.php?controller=admin");
					exit;
				}
			}
		}
		break;



	case "login":
		$pagetitle = "Login";
		$view = "login";
		require("{$ROOT}{$DS}view{$DS}view.php");
		break;

	case "exit":

		unset($_SESSION['admin']);
		unset($_SESSION['id']);
		session_destroy();

		$view = "login";
		require("{$ROOT}{$DS}view{$DS}view.php");
		break;


	case "register":
		$pagetitle = "Register";
		$view = "register";
		require("{$ROOT}{$DS}view{$DS}view.php");
		break;




	case "regist":
		if (isset($_REQUEST['Uname']) && isset($_REQUEST['password'])) {




			$username = $_REQUEST["Uname"];
			$password = password_hash($_REQUEST['password'], PASSWORD_DEFAULT);
			$fname = $_REQUEST["Fname"];
			$lname = $_REQUEST["Lname"];
			$email = $_REQUEST["email"];
			$artname = $_REQUEST["artist"];
			$job = $_REQUEST["role"];
			$sex = $_REQUEST["sex"];
			$birth = $_REQUEST["birth"];
			$tel = $_REQUEST["phone"];
			$admin = "0";


			$id = $username;










			$u = new ModelUser($username, $password, $admin, $fname, $lname, $email, $artname, $job, $sex, $birth, $tel);
			$tab = array(
				"Fname" => $fname,
				"Lname" => $lname,
				"Username" => $username,
				"email" => $email,
				"password" => $password,
				"artname" => $artname,
				"job" => $job,
				"tel" => $tel,
				"sex" => $sex,
				"birth" => $birth,
				"Admin" => $admin

			);
			$u->insert($tab);
			$_SESSION['admin'] = 0;
			$_SESSION['id'] = $username;

			header('Location: index.php?controller=profile&ref='.$username);
		}

		break;
}







?>