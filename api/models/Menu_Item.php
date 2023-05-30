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

    public static function getMenuItems() {
        //Retrieve all menu items
        $menuitems = self::with('menuitemingredient')->get();
        return $menuitems;
    }
    //View a specific item by id
    public static function getMenuItemById(string $itemID) {
        $menuitem = self::findOrFail($itemID);
        $menuitem->load('menuitemingredient');
        return $menuitem;
    }
    // Define the one to many relationship between MenuItem and MenuItemIngredient model classes
    // The first para is the model class name; the second parameter is the foreign key.
    public function menuitemingredient() {
        return $this->hasMany(MenuItemIngredient::class, 'menuitemingredient');
    }
    //View all ingredients in a menu item
    public static function getMenuItemIngredientByMenuItem(string $itemID){
        $menuitemingredient = self::findOrFail($itemID)->menuitemingredient;
        return $menuitemingredient;
    }
    public function getData(){
        $data = self::all();
        return $jsonData;
    }

    public function setData($ingredientID, $name, $description){  
        $this->ingredientID = $ingredientID;
        $this->name = $name;
        $this->description = $description;
    }

}