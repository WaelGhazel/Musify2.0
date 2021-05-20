<?php


require_once("./config/conf.php");

class Model {

    private static $pdo;

    public static function Init(){

        $host = Conf::getHostname();
        $dbname = Conf::getDatabase();
        $login = Conf::getLogin();
        $pass = Conf::getPassword();

        try {
            self::$pdo = new PDO("mysql:host=$host;dbname=$dbname", $login,$pass);

        } catch (PDOException $e) {
            die($e->getMessage());
        }


    }
	public static function getAll(){
	    $SQL="SELECT * FROM ".static::$table." ORDER BY id DESC";
		$rep = model::$pdo->query($SQL);
	    $rep->setFetchMode(PDO::FETCH_CLASS, 'model'.ucfirst(static::$table));
	    return $rep->fetchAll();
	}




	public static function recherche($titre){
		$sql="SELECT * FROM ".static::$table." WHERE titre =:titre";
		$req_prep = model::$pdo->prepare($sql);
		$req_prep->bindParam(":titre", $titre);
		$req_prep->execute();
		 
		 $req_prep->setFetchMode(PDO::FETCH_CLASS, 'model'.ucfirst(static::$table));
	    return $req_prep->fetchAll();
	}





    public function select($cle_primaire) {
	    $sql = "SELECT * from ".static::$table." WHERE ".static::$primary."=:cle_primaire";
	    $req_prep = model::$pdo->prepare($sql);
	    $req_prep->bindParam(":cle_primaire", $cle_primaire);
	    $req_prep->execute();
	    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'model'.ucfirst(static::$table));
	    if ($req_prep->rowCount()==0){
			return null;
			die();
	  	}else{
			$rslt = $req_prep->fetch();
			return $rslt;
		}
	      
  	}


	public function delete($cle_primaire) {
		$sql = "DELETE FROM ".static::$table." WHERE ".static::$primary."=:cle_primaire";
		$req_prep = model::$pdo->prepare($sql);
		$req_prep->bindParam(":cle_primaire", $cle_primaire);
		$req_prep->execute();
	}

	public function update($tab, $cle_primaire) {
		$sql = "UPDATE ".static::$table." SET";
		foreach ($tab as $cle => $valeur){
			$sql .=" ".$cle."=:new".$cle.",";
		}
		$sql=rtrim($sql,",");
		$sql.=" WHERE ".static::$primary."=:oldid;";
		
		  $req_prep = model::$pdo->prepare($sql);
		  $values = array();
	  
	  foreach ($tab as $cle => $valeur){
				$values[":new".$cle] = $valeur;
		  }

		  $values[":oldid"] = $cle_primaire;
		  $req_prep->execute($values);
		  $obj = model::select($tab[static::$primary]);
		  return $obj;
  }

  public static function insert($tab){
    $sql = "INSERT INTO ".static::$table." (`Fname`, `Lname`, `Username`, `email`, `password`, `artname`, `job`, `tel`, `sex`, `birth`, `Admin`) VALUES(";
    foreach ($tab as $cle => $valeur){
		$sql .=" :".$cle.",";
	}
	$sql=rtrim($sql,",");
	$sql.=");";
    $req_prep = model::$pdo->prepare($sql);
    $values = array();
    foreach ($tab as $cle => $valeur){
      		$values[":".$cle] = $valeur;
	}
	$req_prep->execute($values);
	
  }


  public static function login($username, $password) {
	$sql = "SELECT * from ".static::$table." WHERE ".static::$user."=:username ";
	$req_prep = model::$pdo->prepare($sql);
	//$req_prep->bindParam(":username", $username);
	//$req_prep->bindParam(":password", $password);
	$rslt = $req_prep;
	$x=$rslt->fetchObject();
	
	$req_prep->execute(array(
		":username" => $username, 
	));
	if ($req_prep->rowCount()==0){
		return $rslt;
		die();
	  }
      else if(password_verify($password , $x->password)){
            return $rslt;
            die();
        }
		else{
		return $rslt;
	}
	  
  }

}

Model::Init();

?>