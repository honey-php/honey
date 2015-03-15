<?php
/**
 * Database configuration
 */

return array(

    // Default connection name
    'default' => 'mysql',
    
    'connections' => array(
        
        // Connection name
        'mysql' => array(
            /*
             * PDO driver
             * See http://php.net/manual/en/pdo.drivers.php for more information
             */
            'driver'    => 'mysql',

            'host'      => 'localhost',
            'database'  => 'example',
            'username'  => 'root',
            'password'  => '',

            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => ''
        ),
        
        'sqlite' => array(
            'driver' => 'sqlite',
            
            'database' => DATABASE_PATH . '/production.sqlite',
            
            'prefix' => ''
        )
        
    )

);