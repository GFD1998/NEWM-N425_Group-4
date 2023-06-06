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
use McDonaldsAPI\Authentication\{
    MyAuthenticator,
    BasicAuthenticator,
    BearerAuthenticator,
    JWTAuthenticator,
    OAuth2Authenticator
};

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

    $app->group('/api/v1/users', function (RouteCollectorProxy $group) {
        $group->get('', 'User:index');
        $group->get('/oauth2','User:oauth2');
        $group->get('/{id}', 'User:view');
        $group->post('', 'User:create');
        $group->put('/{id}', 'User:update');
        $group->delete('/{id}', 'User:delete');
        $group->post('/authBearer', 'User:authBearer');
        $group->post('/authJWT', 'User:authJWT');
        
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

    $app->get('/update/{table}/{id}', function (Request $request, Response $response, array $args) {

        // $group->get('', 'MenuItem:index');
        // $resource = $args['resource'];
        // $response->getBody()->write("Resource: [$resource]");
        // require("../public/pages/client.php");
        $response->getBody()->write(`<?php
        $table = ` . $args['table'] . `;
        $id = ` . $args['id'] . `;
        ?>` . require "../public/pages/update.php");
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



    $app->group('/api/v1', function (RouteCollectorProxy $group) {
        
        // $group->get('', 'MenuItem:index');
        
        // $app->get('/', function (Request $request, Response $response, array $args) {
        //     $response->getBody()->write("<script>
        //         alert('Hello there.');
        //     </script>");
        //     return $response;
        // });
        //Route group for /menuitems pattern
        $group->group('/menuitems', function(RouteCollectorProxy $group){
            $group->get('', 'MenuItem:index');
            $group->get('/', 'MenuItem:index');
            $group->get('/{element}', 'MenuItem:view');
            $group->post('', 'MenuItem:create');
            $group->put('/{id}', 'MenuItem:update');
            $group->delete('/{itemID}', 'MenuItem:delete');
        });

        $group->group('/allergens', function(RouteCollectorProxy $group){
            $group->get('', 'Allergens:index');
            $group->get('/', 'Allergens:index');
            $group->get('/{element}', 'Allergens:view');
        });

        $group->group('/ingredients', function(RouteCollectorProxy $group){
            $group->get('', 'Ingredient:index');
            $group->get('/', 'Ingredient:index');
            $group->get('/{element}', 'Ingredient:view');
        });

        $group->group('/menuitemingredients', function(RouteCollectorProxy $group){
            $group->get('', 'MenuItemIngredient:index');
            $group->get('/', 'MenuItemIngredient:index');
            $group->get('/{element}', 'MenuItemIngredient:view');
        });

        $group->group('/menuitemallergens', function(RouteCollectorProxy $group){
            $group->get('', 'MenuItemAllergens:index');
            $group->get('/', 'MenuItemAllergens:index');
            $group->get('/{element}', 'MenuItemAllergens:view');
        });

        $group->group('/nutritionalinformation', function(RouteCollectorProxy $group){
            $group->get('', 'NutritionalInformation:index');
            $group->get('/', 'NutritionalInformation:index');
            $group->get('/{element}', 'NutritionalInformation:view');
        });
        // $group->group('/menuitem/{element}', function (RouteCollectorProxy $group, array $args) {
        // //Call the index method defined in the MenuItemsController class
        // //MenuItems is the container key defined in dependencies.php.
        //     // $group->get('', 'MenuItem:index');
        //     // $group->get('/{id}', 'MenuItem:view');
        // });
    // });
    //})->add(new MyAuthenticator());  //MyAuthentication
    })->add(new BasicAuthenticator());
    // })->add(new BearerAuthenticator());
    // })->add(new JWTAuthenticator());
// })->add(new OAuth2Authenticator());






    $app->any('{route:.*}', function(Request $request, Response $response) {
        $response->getBody()->write("Page Not Found");
        return $response->withStatus(404);
    });
};
