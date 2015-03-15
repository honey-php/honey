<?php
/**
 * Defaulft application configuration
 */

return array(

    /*
     |--------------------------------------------------------------------------
     | Application mode
     |--------------------------------------------------------------------------
     |
     | Doesn't affect the internal functionality,
     | use $app->configMode() to get this value if needed
     |
    */
    
    'app.mode' => 'development',
    
    /*
     |--------------------------------------------------------------------------
     | Application debugging
     |--------------------------------------------------------------------------
     |
     | If debugging is enabled, Slim will use its built-in error handler
     | to display diagnostic information for uncaught Exceptions
     |
    */
    'app.debug' => true,
    
    /*
     |--------------------------------------------------------------------------
     | Application custom options
     |--------------------------------------------------------------------------
     |
     | See http://docs.slimframework.com/#Configuration-Overview for more information
     |
    */
    'app.custom' => array(
        
    ),
    
    /*==========================================================================*/
    
    /*
     |--------------------------------------------------------------------------
     | Views path
     |--------------------------------------------------------------------------
    */
    'views.path' => APP_PATH . '/views',
    
    /*
     |--------------------------------------------------------------------------
     | Views debug mode
     |--------------------------------------------------------------------------
     |
     | When debugging is on, the generated templates have a __toString()
     | method that you can use to display the generated nodes
     |
    */
    'views.debug' => true,
    
    /*
     |--------------------------------------------------------------------------
     | Views caching path
     |--------------------------------------------------------------------------
     |
     | When debugging is on, the generated templates have a __toString()
     | method that you can use to display the generated nodes
     |
    */
    'views.cachePath' => CACHE_PATH . '/views/',
    
    /*
     |--------------------------------------------------------------------------
     | Views custom options
     |--------------------------------------------------------------------------
     |
     | See http://twig.sensiolabs.org/doc/api.html#environment-options for more information
     |
    */
    'views.custom' => array(
        
    )

);
