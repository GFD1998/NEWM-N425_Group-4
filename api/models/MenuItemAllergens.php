<?php


class MenuItemAllergensID{

    public $menuItemAllergensID;

    public $allergenID;

    public $itemID;

    function __constructor(){

    }

    public function getData(){
        $data = [$this->menuItemAllergensID, $this->allergenID, $this->itemID];
        $jsonData = json_encode($data);
        return $jsonData;
    }

    public function setData($menuItemAllergensID, $allergenID, $itemID){  
        $this->menuItemAllergensID = $menuItemAllergensID;
        $this->allergenID = $allergenID;
        $this->itemID = $itemID;
    }

}