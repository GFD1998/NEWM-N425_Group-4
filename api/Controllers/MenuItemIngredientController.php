<?php
/**
 * Author: Josh Tuffnell
 * Date: 5/25/23
 * File: MenuItemIngredientController.php
 * Description: file to control menuitemingredient model
 */
namespace MyCollegeAPI\Controllers;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use MyCollegeAPI\Models\MenuItemIngredient;
use MyCollegeAPI\Controllers\ControllerHelper as Helper;


class MenuItemIngredientController {
    //list all items
    public function index(Request $request, Response $response, array $args) : Response {
        $results = MenuItemIngredient::getData();
        return Helper::withJson($response, $results, 200);
    }
    //view a specific item
    public function view(Request $request, Response $response, array $args) : Response {
        $results = MenuItemIngredient::getMenuItemIngredientById($args['element']);
        return Helper::withJson($response, $results, 200);
    }

}