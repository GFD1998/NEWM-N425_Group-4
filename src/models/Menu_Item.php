<?php
namespace MyCollegeAPI\Models;
use Illuminate\Database\Eloquent\Model;

class Menu_Item extends Model{

    public $itemID;

    public $name;

    public $description;

    public $price;

    function __constructor(){

    }
    public static function getItems(){
        //Retrieve all professors
        $menuitem = self::with('classes')->get();
        return $menuitem;
    }
    //view menu item by id
    public static function getMenuItemById(string $id) {
        $menuitem = self::findOrFail($id);
        return $menuitem;
    }
}