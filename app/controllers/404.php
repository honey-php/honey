<?php
/**
 * Implementing 404 page, shows a simple view.
 */

$app->notFound(function() use($app){
    // View rendering
    $app->render('404.twig', array(
        // Passing current URL as a variable
        'url' => $app->currentUrl()
    ));
});