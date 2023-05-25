<?php
/**
 * Author: Josh Tuffnell
 * Date: 5/24/23
 * File: settings.php
 * Description:
 */

// Should be set to 0 in production
error_reporting(E_ALL);

// Should be set to '0' in production
ini_set('display_errors', '1');

// Timezone
date_default_timezone_set('America/New_York');

// Create an anonymous function that sets settings in the container
// The parameter of the function is a Container object
return function (DI\Container $container) {
    $container->set('settings', function () {
        return [
            /*When running Slim 4 in a subdirectory, we need to set the base path of the Slim App.
             * The path should be relative to the htdocs folder. On my server, mycollege-api folder
             * is stored at htdocs/I425/mycollege-api. So the base path is '/I425/mycollege-api'.
            */
            'basePath' => '/client',

            //database settings
            'db' => [
                'driver' => "mysql",
                'host' => 'localhost',
                'name' => "mcdonalds",
                'database' => '',
                'username' => 'phpuser',
                'password' => 'phpuser',
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix' => ''
            ]
        ];
    });
};