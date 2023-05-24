<?php
/**
 * Author: Josh Tuffnell
 * Date: 5/24/23
 * File: bootstrap.php
 * Description:
 */
use DI\Container;
use Slim\Factory\AppFactory;

require '../../vendor/autoload.php';

// Create a Container object using PHP-DI
$container = new Container();

// Set the settings
(require __DIR__ . '/settings.php')($container);

// Set a container for the AppFactory
AppFactory::setContainer($container);

// Create an app
$app = AppFactory::create();

// Set the base path for the app
$app->setBasePath($container->get('settings')['basePath']);

// Add middleware for paring JSON, form data and xml
$app->addBodyParsingMiddleware();

// Add the Slim built-in routing middleware
$app->addRoutingMiddleware();

// Add Error Middleware
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// Get the Custom Error Handler
$customErrorHandler = (require __DIR__ . '/errorhandler.php');

//Set the custom error handler as the default error handler.
//To use the Slim's built-in error handler, simply comment out the following line.
$errorMiddleware->setDefaultErrorHandler($customErrorHandler);

// Register routes
(require __DIR__ . '/routes.php')($app);

// Return the app
return $app;
