<?php


/**
 * 
 * Author: Gabriel Dennett
 * Date: 06/04/2023
 */


 namespace MyCollegeAPI\Controllers;

 use Psr\Http\Message\ServerRequestInterface as Request;
 use Psr\Http\Message\ResponseInterface as Response;
 use MyCollegeAPI\Controllers\ControllerHelper as Helper;
 use MyCollegeAPI\Validation\Validator;
 use MyCollegeAPI\Models\User;
 use MyCollegeAPI\Models\Token;


class UserController{
    // List users
    public function index(Request $request, Response $response, array $args) : Response
    {
        $results = User::getUsers();
        return Helper::withJson($response, $results, 200);
    }

    // View a specific user by its id
    public function view(Request $request, Response $response, array $args) : Response
    {
        $results = User::getUserById($request->getAttribute('id'));
        return Helper::withJson($response, $results, 200);
    }

    // Create a user when the user signs up an account
    public function create(Request $request, Response $response, array $args) : Response
    {
        // Validate the request
        $validation = Validator::validateUser($request);

        // If validation failed
        if (!$validation) {
            $results = [
                'status' => "Validation failed",
                'errors' => Validator::getErrors()
            ];
            return Helper::withJson($response, $results, 500);
        }

        // Validation has passed; Proceed to create the user
        $user = User::createUser($request);

        if(!$user) {
            $results['status']= "User cannot been created.";
            return Helper::withJson($response, $results, 500);
        }

        $results = [
            'status' => 'User has been created',
            'data' => $user
        ];
        return Helper::withJson($response, $results, 201);
    }

    // Update a user
    public function update(Request $request, Response $response, array $args) : Response
    {
        // Validate the request
        $validation = Validator::validateUser($request);

        // If validation failed
        if (!$validation) {
            $results = [
                'status' => "Validation failed",
                'errors' => Validator::getErrors()
            ];
            return Helper::withJson($response, $results, 500);
        }

        //Validation has passed, proceed to update the user
        $user = User::updateUser($request);

        //If update has been failed
        if(!$user) {
            $results['status']= "User cannot been updated.";
            return Helper::withJson($response, $results, 500);
        }

        //Update was successful, send the confirmation
        $results = [
            'status' => "User has been updated.",
            'data' => $user
        ];

        return Helper::withJson($response, $results, 200);
    }

    // Delete a user
    public function delete(Request $request, Response $response, array $args) : Response
    {
        $user = User::deleteUser($request);

        if(!$user) {
            $results['status']= "User cannot been deleted.";
            return Helper::withJson($response, $results, 500);
        }

        $results['status'] = "User has been deleted.";
        return Helper::withJson($response, $results, 200);
    }


    public function authBearer(Request $request, Response $response, array $args) : Response{
        $params = $request->getParsedBody();
        $username = $params['username'];
        $password = $params['password'];
        $user = User::authenticateUser($username, $password);

        if(!$user) {
            return Helper::withJson($response, ['Status' => 'Login failed.'], 401);
        }

        $token = Token::generateBearer($user->id);
        $results = ['Status' => 'Login successful', 'Token' => $token];

        return Helper::withJson($response, $results, 200);
    }

    public function authJWT(Request $request, Response $response){
        $params = $request->getParsedBody();
        $username = $params['username'];
        $password = $params['password'];
        $user = User::authenticateUser($username, $password);

        if(!$user) {
            return Helper::withJson($response, ['Status' => 'Login failed.'], 401);
        }

        $jwt = User::generateJWT($user->id);
        $results = [
            'Status' => 'Login successful',
            'jwt' => $jwt,
            'name' => $user-> name,
            'role' => $user->role
        ];

        return Helper::withJson($response, $results, 200);
    }

    public function oauth2(Request $request, Response $response) : Response {
        $code = $request->getQueryParams()['code'] ?? '';
        $token = User::generateOauth2($code);




        if(filter_var($token, FILTER_VALIDATE_URL)) {
           return $response->withHeader('Location', $token)->withStatus(301);
        }

        if(!$token) {
            return Helper::withJson($response, ['Status' => 'Login failed.'], 401);
        }




        $results = [
            'Status' => 'Login successful',
            'Token' => $token
        ];

        return Helper::withJson($response, $results, 200);
    }
 }