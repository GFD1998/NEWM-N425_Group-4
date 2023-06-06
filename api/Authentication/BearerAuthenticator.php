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


 class BearerAuthenticator {
    public function __invoke(Request $request, RequestHandler $handler) : Response {
        if(!$request->hasHeader('Authorization')) {
            $results = ['Status' => 'Authorization header not available'];
            return AuthenticationHelper::withJson($results, 401);
        }

        $auth = $request->getHeader('Authorization');
        list(, $token) = explode(" ", $auth[0], 2);

        if(!Token::validateBearer($token)) {
            $results = ['Status' => 'Authentication failed.'];
            return AuthenticationHelper::withJson($results, 403);
        }

        return $handler->handle($request);
    }
 }