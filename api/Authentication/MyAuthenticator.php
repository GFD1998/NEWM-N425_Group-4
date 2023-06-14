<?php




/**
 * 
 * Author: Gabriel Dennett
 * Date: 06/04/2023
 */


 namespace McDonaldsAPI\Authentication;

use Slim\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use McDonaldsAPI\Models\User;


class MyAuthenticator{
    public function __invoke(Request $request, RequestHandler $handler) : Response {
        if(!$request->hasHeader('McDonaldsAPI-Authorization')) {
            $results = ['Status' => 'McDonaldsAPI-Authorization header not found.'];
            return AuthenticationHelper::withJson($results, 401);
        }




        $auth = $request->getHeader('McDonaldsAPI-Authorization');
        $apikey = $auth[0];
        list($username,$password) = explode(':',$apikey);



        if(!User::authenticateUser($username, $password)) {
            $results = ['Status' => 'Authentication failed.'];
            return AuthenticationHelper::withJson($results,403);
        }



        return $handler->handle($request);
    }
}