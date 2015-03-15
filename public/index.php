<?php

// Define the root path
define('ROOT_PATH', __DIR__);

// Define paths
require ROOT_PATH . '/../paths.php';

// Register the autoloader
require ROOT_PATH . '/../vendor/autoload.php';

require BOOTSTRAP_PATH . '/config.php';

// Assign class aliases
require BOOTSTRAP_PATH . '/aliases.php';

// Initialize the application and template engine
$app = require BOOTSTRAP_PATH . '/app.php';

// Load filters
require BOOTSTRAP_PATH . '/filters.php';

// Load custom file
if (file_exists($customPath = CUSTOM_PATH . '/custom.php'))
    require $customPath;

// Connect to the database
$app->database = require BOOTSTRAP_PATH . '/database.php';

// Load the routes and assign them
require BOOTSTRAP_PATH . '/controllers.php';

/*hook*/
$app->applyHook('ready', $app);

// Run the application
$app->run();