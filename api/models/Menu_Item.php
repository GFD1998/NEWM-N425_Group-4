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
    // public $itemID;

    // public $name;

    // public $description;

    // public $price;

    //View a specific item by id.
    public static function getDataById(string $ID) {
        $menuitem = self::findOrFail($ID);
        return $menuitem;
    }

    // Define the one to many relationship between Course and MyClass model classes
    // The first parameter is the model class name; the second parameter is the foreign key.
    public function data() {
        return $this->hasMany(Allergens::class, 'AllergenID');
    }

    //View all data from table.
    public static function getData($request){
        //$jsonData = self::all();
        //return $jsonData;
        /*********** code for pagination and sorting *************************/
        //get the total number of row count
        $count = self::count();

        //Get querystring variables from url
        $params = $request->getQueryParams();

        //do limit and offset exist?
        $limit = array_key_exists('limit', $params) ? (int)$params['limit'] : 10;   //items per page
        $offset = array_key_exists('offset', $params) ? (int)$params['offset'] : 0;  //offset of the first item

        //pagination
        $links = self::getLinks($request, $limit, $offset);

        //build query
        /*CHANGE */       $query = self::with('data');  //build the query to get all courses
        $query = $query->skip($offset)->take($limit);  //limit the rows

        //code for sorting
        $sort_key_array = self::getSortKeys($request);
        //soft the output by one or more columns
        foreach ($sort_key_array as $column => $direction) {
            $query->orderBy($column, $direction);
        }

        //retrieve the courses
        /*CHANGE */     $courses = $query->get();  //Finally, run the query and get the results

        //construct the data for response
        $results = [
            'totalCount' => $count,
            'limit' => $limit,
            'offset' => $offset,
            'links' => $links,
            'sort' => $sort_key_array,
            'data' => $courses
        ];

        return $results;
    }

    // Return an array of links for pagination. The array includes links for the current, first, next, and last pages.
    private static function getLinks($request, $limit, $offset) {
        $count = self::count();

        // Get request uri and parts
        $uri = $request->getUri();
        if($port = $uri->getPort()) {
            $port = ':' . $port;
        }
        $base_url = $uri->getScheme() . "://" . $uri->getHost() . $port . $uri->getPath();

        // Construct links for pagination
        $links = [];
        $links[] = ['rel' => 'self', 'href' => "$base_url?limit=$limit&offset=$offset"];
        $links[] = ['rel' => 'first', 'href' => "$base_url?limit=$limit&offset=0"];
        if ($offset - $limit >= 0) {
            $links[] = ['rel' => 'prev', 'href' => "$base_url?limit=$limit&offset=" . $offset - $limit];
        }
        if ($offset + $limit < $count) {
            $links[] = ['rel' => 'next', 'href' => "$base_url?limit=$limit&offset=" . $offset + $limit];
        }
        $links[] = ['rel' => 'last', 'href' => "$base_url?limit=$limit&offset=" . $limit * (ceil($count / $limit) - 1)];

        return $links;
    }
    /*
     * Sort keys are optionally enclosed in [ ], separated with commas;
     * Sort directions can be optionally appended to each sort key, separated by :.
     * Sort directions can be 'asc' or 'desc' and defaults to 'asc'.
     * Examples: sort=[number:asc,title:desc], sort=[number, title:desc]
     * This function retrieves sorting keys from uri and returns an array.
    */
    private static function getSortKeys($request) {
        $sort_key_array = [];

        // Get querystring variables from url
        $params = $request->getQueryParams();

        if (array_key_exists('sort', $params)) {
            $sort = preg_replace('/^\[|\]$|\s+/', '', $params['sort']);  // remove white spaces, [, and ]
            $sort_keys = explode(',', $sort); //get all the key:direction pairs
            foreach ($sort_keys as $sort_key) {
                $direction = 'asc';
                $column = $sort_key;
                if (strpos($sort_key, ':')) {
                    list($column, $direction) = explode(':', $sort_key);
                }
                $sort_key_array[$column] = $direction;
            }
        }

        return $sort_key_array;
    }

    //Create data
    public static function createData($newRequest) {
        $params = $newRequest->getParsedBody();

        $mi = new Menu_Item();
        
        foreach($params as $field => $value){
            // $mi->$field = $value;
            $mi->$field = ($field == "itemID") ? number_format($value, 1) : $value;
        }

        $mi->save();

        return $mi;
    }

    //Update data
    public static function updateData($newRequest) {
        $params = $newRequest->getParsedBody();

        // $mi = new Menu_Item();
        $id = $newRequest->getAttribute('id');
        $mi = self::findOrFail($id);
        if(!$mi){
            return false;
        }
    
        //updating attributes of menu item.
        foreach($params as $field => $value){
            // $mi->$field = $value;
            $mi->$field = $value;
            //($field == "itemID") ? number_format($value, 1) : $value;
        }

        $mi->save();

        return $mi;
    }


    //Search data
    public static function searchData($term) {
        if(is_numeric($term)){
            $query = self::where('itemID', 'like', $term)
            ->orWhere('name', 'like', "%$term%")
            ->orWhere('description', 'like', "%$term%")
            ->orWhere('price', 'like', "%$term%");
        }else {
            $query = self::where('name', 'like', "%$term%")
            ->orWhere('description', 'like', "%$term%");
        }
        return $query->get();
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