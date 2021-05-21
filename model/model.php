<?php


require_once("./config/conf.php");

class Model
{

	public static $pdo;

	public static function Init()
	{

		$host = Conf::getHostname();
		$dbname = Conf::getDatabase();
		$login = Conf::getLogin();
		$pass = Conf::getPassword();

		try {
			self::$pdo = new PDO("mysql:host=$host;dbname=$dbname", $login, $pass);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
	public static function getAll()
	{
		$SQL = "SELECT * FROM " . static::$table;
		$rep = model::$pdo->query($SQL);
		return $rep;
	}




	public static function selectMusic($artist)
	{
		$sql = "SELECT * FROM " . static::$table . " WHERE artist =:artist OR feat =:artist";
		$req_prep = model::$pdo->prepare($sql);
		$req_prep->bindParam(":artist", $artist);
		$req_prep->execute();

		return $req_prep;
	}





	public function searchmusic($search)
	{
		$sql = "SELECT * from " . static::$table . " WHERE name Like $search OR artist LIKE $search OR feat LIKE $search";
		$req_prep=model::$pdo->query($sql);
		if ($req_prep->rowCount() == 0) {
			return -1;
			die();
		} else {
			$rslt = $req_prep;
			return $rslt;
		}
	}
	public function searchartist($search)
	{
		$sql = "SELECT * from " . static::$table . " WHERE artname Like $search OR username LIKE $search";
		$req_prep=model::$pdo->query($sql);
		if ($req_prep->rowCount() == 0) {
			return -1;
			die();
		} else {
			$rslt = $req_prep;
			return $rslt;
		}
	}
	public function selectuser($user)
	{
		$sql = "SELECT * from " . static::$table . " WHERE username LIKE $user";
		$req_prep=model::$pdo->query($sql);
		if ($req_prep->rowCount() == 0) {
			return -1;
			die();
		} else {
			$rslt = $req_prep;
			return $rslt;
		}
	}

	public function delete($cle_primaire)
	{
		$sql = "DELETE FROM " . static::$table . " WHERE " . static::$primary . "=:cle_primaire";
		$req_prep = model::$pdo->prepare($sql);
		$req_prep->bindParam(":cle_primaire", $cle_primaire);
		$req_prep->execute();
	}

	public function update($tab, $cle_primaire)
	{
		$sql = "UPDATE " . static::$table . " SET";
		foreach ($tab as $cle => $valeur) {
			$sql .= " " . $cle . "=:new" . $cle . ",";
		}
		$sql = rtrim($sql, ",");
		$sql .= " WHERE " . static::$primary . "=:oldid;";

		$req_prep = model::$pdo->prepare($sql);
		$values = array();

		foreach ($tab as $cle => $valeur) {
			$values[":new" . $cle] = $valeur;
		}

		$values[":oldid"] = $cle_primaire;
		$req_prep->execute($values);
		$obj = model::select($tab[static::$primary]);
		return $obj;
	}

	public static function insert($tab)
	{
		$sql = "INSERT INTO " . static::$table . " (`Fname`, `Lname`, `Username`, `email`, `password`, `artname`, `job`, `tel`, `sex`, `birth`, `Admin`) VALUES(";
		foreach ($tab as $cle => $valeur) {
			$sql .= " :" . $cle . ",";
		}
		$sql = rtrim($sql, ",");
		$sql .= ");";
		$req_prep = model::$pdo->prepare($sql);
		$values = array();
		foreach ($tab as $cle => $valeur) {
			$values[":" . $cle] = $valeur;
		}
		$req_prep->execute($values);
	}


	public static function login($username, $password)
	{
		$sql = "SELECT * from " . static::$table . " WHERE " . static::$user . "= " . model::$pdo->quote($username);
		//$req_prep->bindParam(":username", $username);
		//$req_prep->bindParam(":password", $password);
		$rslt = model::$pdo->query($sql);
		$x = $rslt->fetchObject();
		if ($rslt->rowCount() == 0) {
			return -1;
			die();
		} else {
			if (password_verify($password, $x->password)) {
				return $rslt;
			} else {
				return -1;
			}
		}
	}
	public static function uploadsong($title, $type, $lang, $song, $image, $artname, $feat, $release, $id)
	{
		$ins = "INSERT INTO " . static::$table . " (`name`, `type`, `lang`, `song`, `cover`, `artist`, `feat`, `rdate`, `ID`) VALUES ($title, $type, $lang, $song, $image, $artname, $feat, $release, $id)";
		model::$pdo->exec($ins);
	}
	public static function selectGigs()
    {
        $gig = "SELECT * FROM gigs ORDER BY post";
        $answergig=model::$pdo->query($gig);
        return $answergig;
    }
	public static function selectUserGigs($user)
    {
        $gig = "SELECT * FROM ".static::$table." WHERE ".static::$user." LIKE $user ORDER BY 'post'";
        $answergig=model::$pdo->query($gig);
        return $answergig;
    }
	public static function insertgig($title, $desc, $uname, $id){
        $ins = "INSERT INTO `gigs` (`username`, `title`, `description`, `post`, `ID`) VALUES ($uname, $title, $desc, SYSDATE(), $id)";
        model::$pdo->exec($ins);
	}
	public static function updateProfileData($fname,$lname,$uname,$email,$artname,$role,$phone,$sex,$birth){
        $ins = "UPDATE ".static::$table." SET `Fname` = $fname, `Lname` = $lname, `email` = $email, `artname` = $artname, `job` = $role, `tel` = $phone, `sex` = $sex, `birth` = $birth WHERE `users`.`Username` = $uname";
        model::$pdo->exec($ins);
    }
	public static function updateProfilePic($profile,$ext,$uname,$pp,$filesize,$filetmpname){
        $ins = "UPDATE ".static::$table." SET `profilepic` = $profile WHERE `users`.`Username` = $uname";
        if($ext!="jpg" && $ext!="png" && $ext!="jpeg"){
        return -1 ;
        }
        else if($filesize > 10000000){
            return -2 ;
        }    
        if (move_uploaded_file($filetmpname,$pp)) {
            model::$pdo->exec($ins);
            return 0 ;
        } else {
            return -3 ;    
        }
    }
    public static function updateCoverPic($cover,$ext,$uname,$pc,$filesize,$filetmpname){
        $ins = "UPDATE ".static::$table." SET `coverpic` = $cover WHERE `users`.`Username` = $uname";
        if($ext!="jpg" && $ext!="png" && $ext!="jpeg"){
        return -1 ;
        }
        else if($filesize > 10000000){
            return -2 ;
        }    
        if (move_uploaded_file($filetmpname,$pc)) {
            model::$pdo->exec($ins);
            return 0 ;
        } else {
            return -3 ;    
        }
    }
	public static function updatePassword($password,$user){
        $ins = "UPDATE ".static::$table." SET `password` = $password WHERE `users`.`Username` = $user";
        model::$pdo->exec($ins);

    }
	public static function insertOffer($sender, $reciver, $title, $desc, $id)
	{
		$sql="INSERT INTO ".static::$table." (`sender`, `reciever`, `title`, `content`, `ID`) VALUES ($sender,	$reciver, $title, $desc, $id)";
		model::$pdo->exec($sql);
	}
	public static function selectOffers($user){
		$sql="SELECT * FROM ".static::$table." WHERE reciever LIKE $user";
		$x=model::$pdo->query($sql);
		return $x;
	}
	public static function updateArtists(){
        $del = "DELETE FROM `artists`";
        $ins = "INSERT INTO `artists` (`username`,`artname`,`role`,`profilepic`) SELECT username , artname , job , profilepic FROM users ";
        $fas= model::$pdo->exec($del);
        $answer = model::$pdo->exec($ins) ;
    }
	public static function selectRole($role){
        $pro="SELECT * FROM ".static::$table." WHERE role like $role";
        $prod=model::$pdo->query($pro);
        return $prod;
    }
	public static function selectSex($s){
        $ml="SELECT * FROM ".static::$table." WHERE sex LIKE $s";
        $mal=model::$pdo->query($ml);
        Return $mal;
    }








}

Model::Init();
