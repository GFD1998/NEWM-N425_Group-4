<?php


class MenuItemIngredient extends Model{

    public $menuitemingredientID;

    public $ingredientID;

    public $itemID;

    function __constructor(){

    }

    public function getData(){
        $data = [$this->menuitemingredientID, $this->ingredientID, $this->itemID];
        $jsonData = json_encode($data);
        return $jsonData;
    }

    public function setData($menuitemingredientID, $ingredientID, $itemID){  
        $this->menuitemingredientID = $menuitemingredientID;
        $this->ingredientID = $ingredientID;
        $this->itemID = $itemID;
    }

}