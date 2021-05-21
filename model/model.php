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
}

Model::Init();
