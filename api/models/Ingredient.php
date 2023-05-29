<?php


class Ingredient{

    public $ingredientID;

    public $name;

    public $description;

    function __constructor(){

    }

    public function getData(){
        // $data = [$this->ingredientID, $this->name, $this->description];
        $data = self::all();
        // $jsonData = json_encode($data);
        return $jsonData;
    }

    public function setData($ingredientID, $name, $description){  
        $this->ingredientID = $ingredientID;
        $this->name = $name;
        $this->description = $description;
    }

}