<?php

/*hook*/
$app->applyHook('database.connection.before');

$capsule = new Capsule;

$config = require CONFIG_PATH . '/database.php';

$capsule->setFetchMode(isset($config['fetch']) ? $config['fetch'] : PDO::FETCH_CLASS);
$capsule->getDatabaseManager()->setDefaultConnection(isset($config['default']) ? $config['default'] : 'default');

$capsule->setAsGlobal();

foreach ($config['connections'] as $name => $connection) {
    $capsule->addConnection($connection, $name);
    
    /*hook*/
    $app->applyHook('database.connection.added', $name, $capsule->getConnection($name));
}

$capsule->bootEloquent();

/*hook*/
$app->applyHook('database.connection.after');

return $capsule;