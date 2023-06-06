<?php




/**
 * 
 * Author: Gabriel Dennett
 * Date: 06/04/2023
 */


 namespace MyCollegeAPI\Authentication;

use Slim\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use MyCollegeAPI\Models\User;

class BasicAuthenticator{
    public function __invoke(Request $request, RequestHandler $handler) : Response {
        if (!$request->hasHeader('Authorization')) {
            $results = ['Status' => 'Authorization header not found.'];
            return AuthenticationHelper::withJson($results, 401);
        }



        $auth = $request->getHeader('Authorization')[0];
        list(, $apikey) = explode(" ", $auth, 2);
        list($user, $password) = explode(':', base64_decode($apikey));



        if(!User::authenticateUser($user, $password)) {
            $results = array('status' => 'Authentication failed');
            $response = AuthenticationHelper::withJson($results, 403);
            return $response->withHeader('WWW-Authenticate', 'Basic realm="MyCollegeAPI API"');
        }

        return $handler->handle($request);
    }
}
