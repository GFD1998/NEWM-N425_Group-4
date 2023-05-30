<?php
/**
 * Author: Josh Tuffnell
 * Date: 5/24/23
 * File: errorhandler.php
 * Description: handles custom errors in routing
 */

use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Slim\Exception\{HttpNotFoundException,
    HttpBadRequestException,
    HttpForbiddenException,
    HttpMethodNotAllowedException,
    HttpInternalServerErrorException,
    HttpUnauthorizedException
};
use Slim\App;

return function (
    ServerRequestInterface $request,
    Throwable              $exception,
    bool                   $displayErrorDetails,
    bool                   $logErrors,
    bool                   $logErrorDetails,
    ?LoggerInterface       $logger = null
) use ($app) {
    $logger?->error($exception->getMessage());

    //Set message and status according to the exception
    switch (get_class($exception)) {
        case ModelNotFoundException::class:
            $status = 404;
            $message = $exception->getMessage();
            break;
        case HttpNotFoundException::class:
            $status = 404;
            $message = 'Page Not Found <br>' . $exception;
            break;
        case HttpBadRequestException::class:
            $status = 400;
            $message = 'The request is invalid. URL or parameters may be wrong.';
            break;
        case HttpUnauthorizedException::class:
            $status = 401;
            $message = 'Invalid login credentials';
            break;
        case HttpForbiddenException::class:
            $status = 403;
            $message = 'Access to the resource is forbidden.';
            break;
        case HttpMethodNotAllowedException::class:
            $status = 405;
            $message = "This request is not supported by the resource.";
            break;
        case HttpInternalServerErrorException::class:
            $status = 500;
            $message = 'Internal Server Error';
            break;
        default:  //default message and status code
            $status = 500;
            $message = $exception->getMessage();
    }
    $results =
        [
            "Title" => "MyCollege-API Application Error",
            "Error" => [
                "Type" => get_class($exception),
                "Code" => $exception->getCode(),
                "Message" => $message,
                "File" => $exception->getFile(),
                "Line" => $exception->getLine(),
            ]
        ];

    //encode into json, remove backslashes, and remove quotes around keys
    $payload = preg_replace('/"([^"]+)"\s*:\s*/', '$1:',
        stripslashes(json_encode($results, JSON_PRETTY_PRINT)));

    $response = $app->getResponseFactory()->createResponse();
    $response->getBody()->write($payload);

    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus($status);
};