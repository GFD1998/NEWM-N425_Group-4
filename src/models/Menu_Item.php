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
    public function getItems()
    {
        return $this->name;
    }
}