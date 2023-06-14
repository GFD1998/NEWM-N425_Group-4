<?php
/**
 * Author: Josh Tuffnell
 * Date: 5/24/23
 * File: dependencies.php
 * Description: file to handle dependencies
 */
use DI\Container;
use McDonaldsAPI\Controllers\MenuItemController;
use McDonaldsAPI\Controllers\IngredientController;
use McDonaldsAPI\Controllers\AllergensController;
use McDonaldsAPI\Controllers\MenuItemIngredientController;
use McDonaldsAPI\Controllers\MenuItemAllergensController;
use McDonaldsAPI\Controllers\NutritionalInformationController;
use McDonaldsAPI\Controllers\UserController;

    return function(Container $container) {
    // Set a dependency called "MenuItem"
        $container->set('MenuItem', function() {
            return new MenuItemController();
        });

        $container->set('Ingredient', function() {
            return new IngredientController();
        });

        $container->set('Allergens', function() {
            return new AllergensController();
        });

        $container->set('MenuItemIngredient', function() {
            return new MenuItemIngredientController();
        });

        $container->set('MenuItemAllergens', function() {
            return new MenuItemAllergensController();
        });

        $container->set('NutritionalInformation', function() {
            return new NutritionalInformationController();
        });

        $container->set('User', function() {
            return new UserController();
        });
    };