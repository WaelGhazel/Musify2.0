<?php

require_once("model.php");

class ModelGigs extends Model{
    private $title;
    private $username;
    private $description;
    private $post ;
    private $id;

  
   
    protected static $table = 'gigs';
    protected static $primary = 'ID';
    protected static $user = 'username';
    protected static $name = 'title';



    public function __construct($title=NULL, $username=NULL, $description=NULL, $post=NULL, $id=NULL)
    {
        if (!is_null($title) && !is_null($username) && !is_null($description) && !is_null($post) ) {
            $this->title = $title;
            $this->username = $username;
            $this->description = $description;
            $this->post = $post;
            $this->id = $id;
           }
        
    }

    public function getId(){
        return $this->id;
    }
    public function gettitle(){
        return $this->title;
    }
    public function getusername(){

        return $this->username;
    }
    public function getdescription(){
        return $this->description;
    }
    public function getpost(){
        return $this->post;
    }

}


?>