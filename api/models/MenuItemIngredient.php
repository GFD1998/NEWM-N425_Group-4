<?php


namespace MyCollegeAPI\Models;
use Illuminate\Database\Eloquent\Model;

class MenuItemIngredient extends Model {
    //table name
    protected $table = 'MenuItemIngredient';
    //primary key
    protected $primaryKey = 'MenuItemIngredientID';
    //PK is numeric
    public $incrementing = true;

    public $timestamps = false;

    //Columns
    public $menuitemingredientID;

    public $ingredientID;

    public $itemID;

    public static function getDataById(string $ID) {
        $menuingredientitem = self::findOrFail($ID);
        return $menuingredientitem;
    }

    //View all data from table.
    public static function getData(){
        $jsonData = self::all();
        return $jsonData;
    }

    //Search data
    public static function searchData($term) {
        if(is_numeric($term)){
            $query = self::where('menuitemingredientID', 'like', "%$term%")
            ->orWhere('ingredientID', 'like', "%$term%")
            ->orWhere('itemID', 'like', "%$term%");
        }
        return $query->get();
    }

}