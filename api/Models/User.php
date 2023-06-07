<?php

/**
 * 
 * Author: Gabriel Dennett
 * Date: 06/04/2023
 */


 namespace McDonaldsAPI\Models;

 use Illuminate\Database\Eloquent\Model;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Google\Client;
use Google\Service\Oauth2;

class User extends Model{

    const JWT_KEY = 'McDonaldsAPI-api-v2$';
    const JWT_EXPIRE = 3600;


    public $table = 'users';
    public $primaryKey = 'id';
    public $incrementing = true;
    public $keyType = 'int';
    public $timestamps = true;

    //List all users
    public static function getUsers() {
        $users = self::all();
        return $users;
    }

    // View a specific user by id
    public static function getUserById(string $id)
    {
        $user = self::findOrFail($id);
        return $user;
    }

    // Create a new user
    public static function createUser($request)
    {
        // Retrieve parameters from request body
        $params = $request->getParsedBody();

        // Create a new User instance
        $user = new User();

        // Set the user's attributes
        foreach ($params as $field => $value) {
            $user->$field = ($field == "password") ? password_hash($value, PASSWORD_DEFAULT) : $value;
        }

        // Insert the user into the database
        $user->save();
        return $user;
    }

    // Update a user
    public static function updateUser($request)
    {
        // Retrieve parameters from request body
        $params = $request->getParsedBody();

        //Retrieve the user's id from url
        $id = $request->getAttribute('id');
        $user = self::findOrFail($id);

        if(!$user) {
            return false;
        }

        //update attributes of the user
        foreach($params as $field => $value) {
            $user->$field =  ($field == "password") ? password_hash($value, PASSWORD_DEFAULT) : $value;
        }

        // Update the user
        $user->save();
        return $user;
    }

    // Delete a user
    public static function deleteUser($request)
    {
        $user = self::findOrFail($request->getAttribute('id'));
        return ($user ? $user->delete() : $user);
    }



/**
 * 
 * Author: Gabriel Dennett
 * Date: 06/04/2023
 */
    //Authenticate a user by username and password
    public static function authenticateUser($username,$password){
        $user =self::where('username',$username)->first();
        if(!$user) {
            return false;
        }

        return password_verify($password, $user->password) ? $user : false;
        // return ($password == $user->password) ? $user : false;
    }



    public static function generateJWT($id) {
        //Data for payload
        $user = self::find($id);

        if(!$user) {
            return false;
        }

        $key = self::JWT_KEY;
        $expiration = time() + self::JWT_EXPIRE;
        $issuer = 'mycollege-api.com';

        $payload = [
            'iss' => $issuer,
            'exp' => $expiration,
            'isa' => time(),
            'data' => [
                'uid' => $id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role
            ]
        ];

        //Generate and return the token
        return JWT::encode(
            $payload,  //data to be encoded in the JWT
            $key,  //the signing key
            'HS256' //algorithm used to sign the token; defaults to HS256
        );
    }

    //Validate a JWT token
    public static function validateJWT($jwt) {
        $decoded = JWT::decode($jwt, new Key(self::JWT_KEY, 'HS256'));
        return $decoded;
    }
    

    public static function generateOauth2($code)
    {
        $client = new Client();
        $client->setAuthConfig(__DIR__ . '/client_secrets.json');
        $client->addScope(Oauth2::OPENID);




        if (!$code) {
            $auth_url = $client->createAuthUrl();
            return $auth_url;
        }



        $token = $client->fetchAccessTokenWithAuthCode($code);
        return $token;
    }

    public static function validateOauth2($token)
    {
        $client = new Client();
        $client->setAuthConfig(__DIR__ . '/client_secrets.json');
        $payload = $client->verifyIdToken($token);
        return ($payload) ? true : false;
    }

}