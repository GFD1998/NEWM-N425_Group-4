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
        $results = Menu_Item::getMenuItems();
        return Helper::withJson($response, $results, 200);
    }

}