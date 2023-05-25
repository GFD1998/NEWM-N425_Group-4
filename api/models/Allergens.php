
<?php


class Allergens{

    public $allergenID;

    public $name;

    public $description;

    function __constructor(){

    }


    public function getData(){
        $data = [$this->allergenID, $this->name, $this->description];
        $jsonData = json_encode($data);
        return $jsonData;
    }

    public function setData($allergenID, $name, $description){  
        $this->allergenID = $allergenID;
        $this->name = $name;
        $this->description = $description;
    }

}