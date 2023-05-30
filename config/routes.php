<?php
/**
 * Author: Josh Tuffnell
 * Date: 5/24/23
 * File: routes.php
 * Description:
 */

use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteCollectorProxy;
use Slim\Routing\RouteContext;

return function (App $app) {
    // move app routes here
    $app->get('/', function (Request $request, Response $response, array $args) {
        $response->getBody()->write("<script>
            window.location.href += 'client';
        </script>");
        return $response;
    });

    $app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
        $name = $args['name'];
        $response->getBody()->write("Hello, $name");

        return $response;
    });

    $app->get('/client/mcdonalds/{resource}', function (Request $request, Response $response, array $args) {
        $resource = $args['resource'];
        $response->getBody()->write("Resource: [$resource]");

        return $response;
    });

    $app->get('/client', function (Request $request, Response $response) {
        // require("../public/pages/client.php");
        $response->getBody()->write('' . require "../public/pages/client.php");

        return $response;
    });


    
    $app->get('/search', function (Request $request, Response $response) {
        // require("../public/pages/client.php");
        $response->getBody()->write('' . require "../public/pages/search.php");

        return $response;
    });

    
    $app->get('/update', function (Request $request, Response $response) {
        // require("../public/pages/client.php");
        $response->getBody()->write('' . require "../public/pages/update.php");

        return $response;
    });

    
    $app->get('/delete', function (Request $request, Response $response) {
        // require("../public/pages/client.php");
        $response->getBody()->write('' . require "../public/pages/delete.php");

        return $response;
    });


    $app->get('/view', function (Request $request, Response $response) {
        // require("../public/pages/client.php");
        $response->getBody()->write('' . require "../public/pages/view.php");

        return $response;
    });



    $app->group('api/resources', function (RouteCollectorProxy $group) {

        
        // $app->get('/', function (Request $request, Response $response, array $args) {
        //     $response->getBody()->write("<script>
        //         alert('Hello there.');
        //     </script>");
        //     return $response;
        // });
        //Route group for /menuitems pattern
        $group->group('/menuitems', function (RouteCollectorProxy $group) {
        //Call the index method defined in the MenuItemsController class
        //MenuItems is the container key defined in dependencies.php.

            $group->group('/menuitem', function(RouteCollectorProxy $group){
                $group->get('', 'MenuItem:index');
            });
            // $group->get('', 'MenuItem:index');
            // $group->get('/{id}', 'MenuItem:view');
        });
    });

















    // //Route group api/v1 pattern
    // $app->group('/api/v1', function (RouteCollectorProxy $group) {
    // //Route group for /menuitems pattern
    //     $group->group('/menuitems', function (RouteCollectorProxy $group) {
    // //Call the index method defined in the MenuItemsController class
    // //MenuItems is the container key defined in dependencies.php.
    //         $group->get('', 'MenuItems:index');
    //         $group->get('/{id}', 'MenuItems:view');
    //     });
    // });
    // Handle invalid routes
    $app->any('{route:.*}', function(Request $request, Response $response) {
        $response->getBody()->write("Page Not Found");
        return $response->withStatus(404);
    });
};