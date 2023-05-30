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
use MyCollegeAPI\Models\NutritionalInformation;
use MyCollegeAPI\Controllers\ControllerHelper as Helper;
class NutritionalInformationController {
    //Retrieve all the menu item ingredients
    public function index(Request $request, Response $response, array $args) : Response {
        $results = MenuItemIngredient::getData();
        return Helper::withJson($response, $results, 200);
    }
    //View a specific ingredient by section number
    public function view(Request $request, Response $response, array $args) : Response {
        $results = MenuItemIngredient::getDataByTerm($args['section']);
        return Helper::withJson($response, $results, 200);
    }

}