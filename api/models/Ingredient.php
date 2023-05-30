<?php


class Ingredient{

    public $ingredientID;

    public $name;

    public $description;

    function __constructor(){

    }

    public function getData(){
        $data = self::all();
        return $jsonData;
    }

    public function setData($ingredientID, $name, $description){  
        $this->ingredientID = $ingredientID;
        $this->name = $name;
        $this->description = $description;
    }

}