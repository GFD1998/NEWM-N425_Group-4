<?php


class NutritionalInformation{

    public $nutritionalInformationID;

    public $servingSize;

    public $calories;
    
    public $totalFat;
    
    public $sodium;

    public $cholesterol;

    public $carbohydrates;

    public $sugars;

    public $protein;
    
    public $vitaminA;

    public $vitaminC;

    public $calcium;

    public $iron;
    
    public $itemID;

    function __constructor(){

    }

    public function getData(){
        $data = [$this->nutritionalInformationID, $this->servingSize, $this->calories, $this->totalFat, $this->sodium, $this->cholesterol, $this->carbohydrates, $this->sugars, $this->protein, $this->vitaminA, $this->vitaminC, $this->calcium, $this->iron, $this->itemID];
        $jsonData = json_encode($data);
        return $jsonData;
    }

    public function setData($nutritionalInformationID, $servingSize, $calories, $totalFat, $sodium, $cholesterol, $carbohydrates, $sugars, $protein, $vitaminA, $vitaminC, $calcium, $iron, $itemID){
        $this->nutritionalInformationID = $nutritionalInformationID;
        $this->servingSize = $servingSize;
        $this->calories = $calories;
        $this->totalFat = $totalFat;
        $this->sodium = $sodium;
        $this->cholesterol = $cholesterol;
        $this->carbohydrates = $carbohydrates;
        $this->sugars = $sugars;
        $this->protein = $protein;
        $this->vitaminA = $vitaminA;
        $this->vitaminC = $vitaminC;
        $this->calcium = $calcium;
        $this->iron = $iron;
        $this->itemID = $itemID;
    }
}