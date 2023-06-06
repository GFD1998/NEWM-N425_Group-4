<?php
/**
 * Author: Josh Tuffnell
 * Date: 5/24/23
 * File: dependencies.php
 * Description: file to handle dependencies
 */
use DI\Container;
use MyCollegeAPI\Controllers\MenuItemController;
use MyCollegeAPI\Controllers\IngredientController;
use MyCollegeAPI\Controllers\AllergensController;
use MyCollegeAPI\Controllers\MenuItemIngredientController;
use MyCollegeAPI\Controllers\MenuItemAllergensController;
use MyCollegeAPI\Controllers\NutritionalInformationController;
use MyCollegeAPI\Controllers\UserController;

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