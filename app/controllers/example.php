<?php
/**
 * An example route showing 5 last IPs that visited the site.
 */

use App\Models\Guest; // Using "Guest" model

/*
 * This route uses an example filter, try it by adding
 * "?code=topsecret" to the URL address in your browser
 * You can edit this in config/filters.php.
 */

$app->get('/', $app->filter('exampleFilter'), function() use($app){ // "example.com/" - index
    // Adding a new record
    $guest = new Guest;
    $guest->ip = $app->request->getIp();
    $guest->save();
    
    // Auto-deleting old records
    Guest::where('id', '<=', ($guest->id)-5)->delete();
    
    // Getting last 5 records
    $guests = Guest::orderBy('id', 'desc')->take(5)->get();
    
    // View rendering
    $app->render('index.twig', array(
        'guests' => $guests
    ));
})->name('example');