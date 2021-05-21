<?php

require_once("model.php");

class ModelArtist extends Model{
    private $artname;
    private $username;
    private $description;
    private $role ;
    private $profile;

  
   
    protected static $table = 'artists';
    protected static $primary = 'username';
    protected static $user = 'username';
    protected static $name = 'artname';



    public function __construct($username=NULL, $artname=NULL, $role=NULL, $description=NULL, $profile=NULL)
    {
        if (!is_null($artname) && !is_null($username) && !is_null($description) && !is_null($role) ) {
            $this->artname = $artname;
            $this->username = $username;
            $this->description = $description;
            $this->role = $role;
            $this->profile = $profile;
           }
        
    }

    public function getartname(){
        return $this->artname;
    }
    public function getrole(){
        return $this->role;
    }
    public function getusername(){

        return $this->username;
    }
    public function getdescription(){
        return $this->description;
    }
    public function getprofile(){
        return $this->profile;
    }

}


?>