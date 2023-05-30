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

    public static function getMenuItemIngredientById(string $ID) {
        $menuingredientitem = self::findOrFail($ID);
        return $menuingredientitem;
    }

    //View all data from table.
    public static function getData(){
        $jsonData = self::all();
        return $jsonData;
    }

    // //Update data in table row.
    // public static function setData($ingredientID, $name, $description){  
    //     $this->ingredientID = $ingredientID;
    //     $this->name = $name;
    //     $this->description = $description;
    // }

}