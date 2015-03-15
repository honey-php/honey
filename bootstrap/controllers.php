<?php

$controllers = require CONFIG_PATH . '/controllers.php';
foreach ($controllers as $controller) {
    if ($controller)
        require APP_PATH . '/controllers/' . $controller . '.php';
}