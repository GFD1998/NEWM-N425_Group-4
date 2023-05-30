<?php

namespace MyCollegeAPI\Models;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model {
    //table name
    protected $table = 'Ingredient';
    //primary key
    protected $primaryKey = 'IngredientID';
    //PK is numeric
    public $incrementing = true;

    public $timestamps = false;

    //Columns
    public $ingredientID;

    public $name;

    public $description;

    public static function getIngredientById(string $ID) {
        $ingredientitem = self::findOrFail($ID);
        return $ingredientitem;
    }

    //View all data from table.
    public static function getData(){
        $jsonData = self::all();
        return $jsonData;
    }

}