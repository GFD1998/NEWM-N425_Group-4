<?php
/**
 * Author: Josh Tuffnell
 * Date: 5/23/23
 * File: Professor.php
 * Description: defines the professor model class
 */
namespace MyCollegeAPI\Models;
use Illuminate\Database\Eloquent\Model;

class Menu_Item extends Model {
    //table name
    protected $table = 'menu_item';
    //primary key
    protected $primaryKey = 'itemID';
    //PK is numeric
    public $incrementing = true;

    public $timestamps = false;

    //Columns
    public $itemID;

    public $name;

    public $description;

    public $price;

    //View a specific item by id.
    public static function getDataById(string $ID) {
        $menuitem = self::findOrFail($ID);
        return $menuitem;
    }

    //View all data from table.
    public static function getData(){
        $jsonData = self::all();
        return $jsonData;
    }

    //Search data
    public static function searchData($term) {
        if(is_numeric($term)){
            $query = self::where('itemID', '>=', $term);
        } else {
            $query = self::where('name', 'like', "%$term%")
            ->orWhere('description', 'like', "%$term%")
            ->orWhere('price', 'like', "%$term%");
        }
        return $query->get();
    }

    //Create data
    public static function createData($newRequest) {
        $params = $newRequest->getParseBody();

        $mi = new Menu_Item();
        
        foreach($params as $field => $value){
            $mi->$field = $value;
        }

        $mi->save();

        return $mi;
    }

}











    // public static function getMenuItems() {
    //     //Retrieve all menu items
    //     $menuitems = self::with('menuitemingredient')->get();
    //     return $menuitems;
    // }
        // Define the one to many relationship between MenuItem and MenuItemIngredient model classes
    // The first para is the model class name; the second parameter is the foreign key.
    // public function menuitemingredient() {
    //     return $this->hasMany(MenuItemIngredient::class, 'menuitemingredient');
    // }
    // //View all ingredients in a menu item
    // public static function getMenuItemIngredientByMenuItem(string $itemID){
    //     $menuitemingredient = self::findOrFail($itemID)->menuitemingredient;
    //     return $menuitemingredient;
    // }