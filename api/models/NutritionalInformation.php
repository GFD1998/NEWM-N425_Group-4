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

    public static function getDataById(string $ID) {
        $nutritionalinformationitem = self::findOrFail($ID);
        return $nutritionalinformationitem;
    }

    //View all data from table.
    public static function getData(){
        $jsonData = self::all();
        return $jsonData;
    }

    //Search data
    public static function searchData($term) {
        if(is_numeric($term)){
            $query = self::where('nutritionalInformationID', 'like', $term)
            ->orWhere('servingSize', 'like', "%$term%")
            ->orWhere('calories', 'like', "%$term%")
            ->orWhere('totalFat', 'like', "%$term%")
            ->orWhere('sodium', 'like', "%$term%")
            ->orWhere('cholesterol', 'like', "%$term%")
            ->orWhere('carbohydrates', 'like', "%$term%")
            ->orWhere('sugars', 'like', "%$term%")
            ->orWhere('protein', 'like', "%$term%")
            ->orWhere('vitaminA', 'like', "%$term%")
            ->orWhere('vitaminC', 'like', "%$term%")
            ->orWhere('calcium', 'like', "%$term%")
            ->orWhere('iron', 'like', "%$term%")
            ->orWhere('itemID', 'like', "%$term%");
        }
        return $query->get();
    }
}