<?php

require_once("model.php");

class ModelOffer extends Model{
    private $title;
    private $sender;
    private $description;
    private $reciever ;
    private $id;

  
   
    protected static $table = 'offers';
    protected static $primary = 'ID';
    protected static $user = 'sender';
    protected static $name = 'title';



    public function __construct($title=NULL, $sender=NULL, $description=NULL, $reciever=NULL, $id=NULL)
    {
        if (!is_null($title) && !is_null($sender) && !is_null($description) && !is_null($reciever) ) {
            $this->title = $title;
            $this->sender = $sender;
            $this->description = $description;
            $this->reciever = $reciever;
            $this->id = $id;
           }
        
    }

    public function getId(){
        return $this->id;
    }
    public function gettitle(){
        return $this->title;
    }
    public function getsender(){

        return $this->sender;
    }
    public function getdescription(){
        return $this->description;
    }
    public function getreciever(){
        return $this->reciever;
    }

}


?>