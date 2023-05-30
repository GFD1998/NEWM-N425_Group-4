<?php


namespace MyCollegeAPI\Models;
use Illuminate\Database\Eloquent\Model;


class NutritionalInformation extends Model {
    //table name
    protected $table = 'NutritionalInformation';
    //primary key
    protected $primaryKey = 'NutritionalInformationID';
    //PK is numeric
    public $incrementing = true;

    public $timestamps = false;

    //Columns
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

    public static function getNutritionalInformationById(string $ID) {
        $nutritionalinformationitem = self::findOrFail($ID);
        return $nutritionalinformationitem;
    }

    //View all data from table.
    public static function getData(){
        $jsonData = self::all();
        return $jsonData;
    }

    // public function setData($nutritionalInformationID, $servingSize, $calories, $totalFat, $sodium, $cholesterol, $carbohydrates, $sugars, $protein, $vitaminA, $vitaminC, $calcium, $iron, $itemID){
    //     $this->nutritionalInformationID = $nutritionalInformationID;
    //     $this->servingSize = $servingSize;
    //     $this->calories = $calories;
    //     $this->totalFat = $totalFat;
    //     $this->sodium = $sodium;
    //     $this->cholesterol = $cholesterol;
    //     $this->carbohydrates = $carbohydrates;
    //     $this->sugars = $sugars;
    //     $this->protein = $protein;
    //     $this->vitaminA = $vitaminA;
    //     $this->vitaminC = $vitaminC;
    //     $this->calcium = $calcium;
    //     $this->iron = $iron;
    //     $this->itemID = $itemID;
    // }
}