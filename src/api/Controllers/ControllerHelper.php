<?php
/**
 * Author: Josh Tuffnell
 * Date: 5/24/23
 * File: ControllerHelper.php
 * Description: file that defines a class with one static method
 */
namespace MyCollegeAPI\Controllers;

use Psr\Http\Message\ResponseInterface as Response;

class ControllerHelper {

    // This method sends a response of data in JSON format along with a status code
    public static function withJson(Response $response, $data, int $code) : Response {
        $payload = json_encode($data);
        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($code);
    }
}