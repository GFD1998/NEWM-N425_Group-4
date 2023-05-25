<?php
/**
 * Author: Josh Tuffnell
 * Date: 5/24/23
 * File: eloquent.php
 * Description: file to add eloquent
 */
use DI\Container;
use Illuminate\Database\Capsule\Manager;

return static function (Container $container) {
    // boot eloquent
    $capsule = new Manager;
    $capsule->addConnection($container->get('settings')['db']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
};