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

return function (App $app){
  // move app routes here
    $app->get('/', function( Request $request, Response $response, array $args) {
        return $response->withHeader('Location', 'client');
    });

    $app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
        $name = $args['name'];
        $response->getBody()->write("Hello, $name");

        return $response;
    });

    $app->get('/mcdonalds/{resource}', function( Request $request, Response $response, array $args) {
        $resource = $args['resource'];
        $response->getBody()->write("Resource: [$resource]");

        return $response;
    });

    $app->get('/client', function( Request $request, Response $response ) {

        $response->getBody()->write("

        <head>
            <title>McDonald's Resource API</title>
        </head>
        <link rel='stylesheet' href='css/main.css' />
        <div class='clientContainer'>
            <input id='tableValue' type='text' placeholder='Enter table...' />
            <p id='submitBtn'>Submit</p>
        </div>

        <script>
            var submitBtn = document.getElementById(\"submitBtn\");

            submitBtn.onclick = () => {
                if(!document.getElementById(\"tableValue\").value){
                    alert('You must input a resource value.');
                }else{
                    var url = window.location.href;
                    url = url.split('/')[0];
                    window.location.href = url + '/mcdonalds/' + document.getElementById(\"tableValue\").value;
                }
            };
        </script>
    ");

        return $response;
    });


    $app->run();

    // Handle invalid routes
    $app->any('{route:.*}', function(Request $request, Response $response) {
        $response->getBody()->write("Page Not Found");
        return $response->withStatus(404);
    });
};