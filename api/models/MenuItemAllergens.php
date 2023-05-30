<?php

namespace MyCollegeAPI\Models;
use Illuminate\Database\Eloquent\Model;


class MenuItemAllergens extends Model {
    //table name
    protected $table = 'MenuItemAllergens';
    //primary key
    protected $primaryKey = 'MenuItemAllergensID';
    //PK is numeric
    public $incrementing = true;

    public $timestamps = false;

    //Columns
    public $menuItemAllergensID;

    public $allergenID;

    public $itemID;

    public static function getDataById(string $ID) {
        $menuitemallergensitem = self::findOrFail($ID);
        return $menuitemallergensitem;
    }

    //View all data from table.
    public static function getData(){
        $jsonData = self::all();
        return $jsonData;
    }

    //Search data
    public static function searchData($term) {
        if(is_numeric($term)){
            $query = self::where('menuItemAllergensID', 'like', $term)
            ->orWhere('allergenID', 'like', "%$term%")
            ->orWhere('itemID', 'like', "%$term%");
        }
        return $query->get();
    }
}