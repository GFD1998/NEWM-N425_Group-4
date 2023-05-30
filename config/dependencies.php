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
        $container->set('MenuItem', function() {
            return new MenuItemController();
        });

        $container->set('MenuItemIngredient', function() {
            return new MenuItemIngredientController();
        });

        $container->set('Ingredient', function() {
            return new IngredientController();
        });

        $container->set('Allergens', function() {
            return new AllergensController();
        });

        $container->set('MenuItemAllergens', function() {
            return new MenuItemAllergensController();
        });

        $container->set('NutritionalInformation', function() {
            return new NutritionalInformationController();
        });

    };