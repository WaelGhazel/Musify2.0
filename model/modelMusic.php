<?php

require_once("model.php");

class ModelMusic extends Model{
    private $title;
    private $type;
    private $lang;
    private $song ;
    private $image ;
    private $artname ;
    private $feat ;
    private $release ;
    private $id;

  
   
    protected static $table = 'music';
    protected static $primary = 'ID';
    protected static $artist = 'artist';
    protected static $name = 'name';



    public function __construct($title=NULL, $type=NULL, $lang=NULL, $song=NULL, $image=NULL, $artname=NULL, $feat=NULL, $release=NULL, $id=NULL)
    {
        if (!is_null($title) && !is_null($song) && !is_null($image) && !is_null($artname) ) {
            $this->title = $title;
            $this->type = $type;
            $this->lang = $lang;
            $this->song = $song;
            $this->image = $image;
            $this->artname = $artname;
            $this->feat = $feat;
            $this->release = $release ;
            $this->id = $id;
           }
        
    }

    public function getId(){
        return $this->id;
    }
    public function gettitle(){
        return $this->title;
    }
    public function gettype(){

        return $this->type;
    }
    public function getlang(){
        return $this->lang;
    }
    public function getsong(){
        return $this->song;
    }
    public function getimage(){
        return $this->image;
    }
    public function getartname(){
        return $this->artname;
    }
    public function getfeat(){
        return $this->feat;
    }
    public function getrelease(){
        return $this->release;
    }

}


?>