<?php


class Menu_Item{

    public $itemID;

    public $name;

    public $description;

    public $price;

    function __constructor(){

    }

    public function getData(){
        $data = [$this->itemID, $this->name, $this->description, $this->price];
        $jsonData = json_encode($data);
        return $jsonData;
    }

    public function setData($itemID, $name, $description, $price){  
        $this->itemID = $itemID;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

}