<?php

namespace MyCollegeAPI\Models;
use Illuminate\Database\Eloquent\Model;

class Allergens extends Model {
    //table name
    protected $table = 'Allergens';
    //primary key
    protected $primaryKey = 'AllergensID';
    //PK is numeric
    public $incrementing = true;

    public $timestamps = false;

    //Columns
    public $allergenID;

    public $name;

    public $description;

    function __constructor(){

    }


    public static function getAllergensById(string $ID) {
        $allergensitem = self::findOrFail($ID);
        return $allergensitem;
    }

    //View all data from table.
    public static function getData(){
        $jsonData = self::all();
        return $jsonData;
    }

}