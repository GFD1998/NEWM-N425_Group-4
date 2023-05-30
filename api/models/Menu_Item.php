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
    public static function getMenuItemById(string $ID) {
        $menuitem = self::findOrFail($ID);
        return $menuitem;
    }

    //View all data from table.
    public static function getData(){
        $jsonData = self::all();
        return $jsonData;
    }

    // //Update data in table row.
    // public static function setData($ingredientID, $name, $description, $price){  
    //     $this->ingredientID = $ingredientID;
    //     $this->name = $name;
    //     $this->description = $description;
    //     $this->price = $price;
    // }

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