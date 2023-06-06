<?php
/**
 * Author: Josh Tuffnell
 * Date: 5/25/23
 * File: MenuItemIngredientController.php
 * Description: file to control menuitemingredient model
 */
namespace McDonaldsAPI\Controllers;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use McDonaldsAPI\Models\MenuItemAllergens;
use McDonaldsAPI\Controllers\ControllerHelper as Helper;


class MenuItemAllergensController {
    //list all items
    public function index(Request $request, Response $response, array $args) : Response {
        $params = $request->getQueryParams();
        $term = array_key_exists('a', $params) ? $params['a'] : "";

        $results = ($term) ? MenuItemAllergens::searchData($term) : MenuItemAllergens::getData($request);
        return Helper::withJson($response, $results, 200);
    }
    //view a specific item
    public function view(Request $request, Response $response, array $args) : Response {
        $results = MenuItemAllergens::getDataById($args['element']);
        return Helper::withJson($response, $results, 200);
    }

    //Create a student
    public function create(Request $request, Response $response, array $args) : Response {
        //Create a new student
        $mi = Menu_Item::createData($request);
        if(!$mi) {
            $results['status']= "Menu item cannot been created.";
            return Helper::withJson($response, $results, 500);
        }

        $results = [
            'status' => "Menu item has been created.",
            'data' => $mi
        ];

        return Helper::withJson($response, $results, 200);
    }

}