<?php

require_once("model.php");

class ModelUser extends Model{
    private $username;
    private $password;
    private $admin;
    private $fname ;
    private $lname ;
    private $email ;
    private $artname ;
    private $job ;
    private $sex ;
    private $birth ;
    private $tel;
    private $propic;
    private $coverpic;
    private $id;

  
   
    protected static $table = 'users';
    protected static $primary = 'Username';
    protected static $user = 'Username';
    protected static $pass = 'password';



    public function __construct( $username = NULL, $password = NULL , $admin = NULL , $fname = NULL ,$lname = NULL ,$email = NULL ,$artname = NULL ,$job = NULL ,$sex = NULL ,$birth = NULL ,$tel = NULL ,$propic = NULL ,$coverpic = NULL)
    {
        if (!is_null($username) && !is_null($password) && !is_null($admin) ) {
            $this->username = $username;
            $this->password = $password;
            $this->admin = $admin;
            $this->fname = $fname;
            $this->lname = $lname;
            $this->email = $email;
            $this->artname = $artname;
            $this->job = $job ;
            $this->sex = $sex;
            $this->birth =$birth;
            $this->tel = $tel;
            $this->propic = $propic;
            $this->coverpic = $coverpic;
           }
        
    }

    public function getId(){
        return $this->id;
    }
    public function getusername(){
        return $this->username;
    }
    public function getpassword(){

        return $this->password;
    }
    public function getadmin(){
        return $this->admin;
    }
    public function getfname(){
        return $this->fname;
    }
    public function getlname(){
        return $this->lname;
    }
    public function getemail(){
        return $this->email;
    }
    public function getartname(){
        return $this->artname;
    }
    public function getjob(){
        return $this->job;
    }
    public function getbirth(){
        return $this->birth;
    }
    public function gettel(){
        return $this->tel;
    }
    public function getpropic(){
        return $this->propic;
    }
    public function getcoverpic(){
        return $this->coverpic;
    }

}


?>