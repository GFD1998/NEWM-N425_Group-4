<?php
/**
 * Author: Josh Tuffnell
 * Date: 5/24/23
 * File: MenuItemController.php
 * Description: file to control menu item Models
 */
namespace MyCollegeAPI\Controllers;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use MyCollegeAPI\Models\Menu_Item;
use MyCollegeAPI\Controllers\ControllerHelper as Helper;


class MenuItemController {
    //list all items
    public function index(Request $request, Response $response, array $args) : Response {
        $params = $request->getQueryParams();
        $term = array_key_exists('a', $params) ? $params['a'] : "";

        $results = ($term) ? Menu_Item::searchData($term) : Menu_Item::getData();

        return Helper::withJson($response, $results, 200);
    }
    //view a specific item
    public function view(Request $request, Response $response, array $args) : Response {
        $results = Menu_Item::getDataById($args['element']);
        return Helper::withJson($response, $results, 200);
    }

    public function create(Request $request, Response $response, array $args) : Response{
        $mi = Menu_Item::createData($request);
        
        if(!$mi){
            $results['status'] = "Menu Item failed to populate.";
            return Helper::withJson($response, $results, 500);
        }

        $results = [
            'status' => "Menu Item was created successfully.",
            'data' => $mi
        ];

        return Helper::withJson($response, $results, 200);
    }

}