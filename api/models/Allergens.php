<?php

namespace MyCollegeAPI\Models;
use Illuminate\Database\Eloquent\Model;

class Allergens extends Model {
    //table name
    protected $table = 'Allergens';
    //primary key
    protected $primaryKey = 'AllergenID';
    //PK is numeric
    public $incrementing = true;

    public $timestamps = false;

    //Columns
    public $allergenID;

    public $name;

    public $description;


    public static function getDataById(string $ID) {
        $allergensitem = self::findOrFail($ID);
        return $allergensitem;
    }

    //View all data from table.
    public static function getData(){
        //$jsonData = self::all();
        //return $jsonData;
        /*********** code for pagination and sorting *************************/
        //get the total number of row count
        $count = self::count();
        
    //Search data
    public static function searchData($term) {
        if(is_numeric($term)){
            $query = self::where('allergenID', '>=', $term);
        } else {
            $query = self::where('name', 'like', "%$term%")
            ->orWhere('description', 'like', "%$term%");
        }
        return $query->get();
    }
}