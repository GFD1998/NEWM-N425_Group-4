<?php
/**
 * Author: Josh Tuffnell
 * Date: 5/24/23
 * File: dependencies.php
 * Description: file to handle dependencies
 */
use DI\Container;
use MyCollegeAPI\Controllers\MenuItemController;

    return function(Container $container) {
    // Set a dependency called "MenuItem"
        $container->set('MenuItems', function() {
            return new MenuItemController();
        });

    };