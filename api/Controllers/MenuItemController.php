<?php
/**
 * Author: Josh Tuffnell
 * Date: 5/24/23
 * File: MenuItemController.php
 * Description: file to control menu item Models
 */
namespace McDonaldsAPI\Controllers;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use McDonaldsAPI\Models\Menu_Item;
use McDonaldsAPI\Validation\Validator;
use McDonaldsAPI\Controllers\ControllerHelper as Helper;


class MenuItemController {
    //list all items
    public function index(Request $request, Response $response, array $args) : Response {
        $params = $request->getQueryParams();
        $term = array_key_exists('a', $params) ? $params['a'] : "";

<<<<<<< Updated upstream
        $results = ($term) ? Menu_Item::searchData($term) : Menu_Item::getData($request);

=======
        $results = ($term) ? Menu_Item::searchData($term) : Menu_Item::getData();
>>>>>>> Stashed changes
        return Helper::withJson($response, $results, 200);
    }
    //view a specific item
    public function view(Request $request, Response $response, array $args) : Response {
        $results = Menu_Item::getDataById($args['element']);
<<<<<<< Updated upstream
=======
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

>>>>>>> Stashed changes
        return Helper::withJson($response, $results, 200);
    }

    public function create(Request $request, Response $response, array $args) : Response{
        // validate the request
        $validation = Validator::validateMenuItem($request);

        if(!$validation) {
            $results = [
                'status' => "Validation failed",
                'errors' => Validator::getErrors()
            ];
            return Helper::withJson($response, $results, 500);
        }


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
    
    //Delete a Menu Item
    public function delete(Request $request, Response $response, array $args) : Response {
        $menuitem = Menu_Item::deleteMenuItem($request);
        if(!$menuitem) {
            $results['status']= "Menu Item cannot be deleted.";
            return Helper::withJson($response, $results, 500);
        }

        $results['status'] = "Menu Item has been deleted.";
        return Helper::withJson($response, $results, 200);
    }



    public function update(Request $request, Response $response, array $args) : Response{
        // validate the request
        $validation = Validator::validateMenuItem($request);

        if(!$validation) {
            $results = [
                'status' => "Validation failed",
                'errors' => Validator::getErrors()
            ];
            return Helper::withJson($response, $results, 500);
        }


        $mi = Menu_Item::updateData($request);
        
        if(!$mi){
            $results['status'] = "Menu Item failed to populate.";
            return Helper::withJson($response, $results, 500);
        }

        $results = [
            'status' => "Menu Item was updated successfully.",
            'data' => $mi
        ];

        return Helper::withJson($response, $results, 200);
    }


    

}
