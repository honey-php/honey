<?php namespace App\Models;
/**
 * An example model
 */

use Model, Capsule;

class Guest extends Model
{
    protected $table = 'guests';
}

/** --------------------------------------------------
 * Example built-in migration
 */

// Checking for an existing table
if (Capsule::schema()->hasTable('guests')) return;

// Creating the table
Capsule::schema()->create('guests', function($table){
    $table->increments('id');
    $table->string('ip');
    $table->timestamps();
});