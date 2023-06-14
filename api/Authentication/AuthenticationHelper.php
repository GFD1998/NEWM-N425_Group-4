<?php


/**
 * 
 * Author: Gabriel Dennett
 * Date: 06/04/2023
 */

namespace McDonaldsAPI\Authentication;

use Slim\Psr7\Response;

class AuthenticationHelper{
    public static function withJson($data, int $code) : Response{
        $response = new Response();
        $response->getBody()->write(json_encode($data));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($code);
    }
}