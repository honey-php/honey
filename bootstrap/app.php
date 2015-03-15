<?php
ob_start();
session_cache_limiter(false);
session_start();

$app = new Berry\Berry(
    array_merge(array(
        'mode' => App\Config::get('app.mode'),
        'debug' => App\Config::get('app.debug'),
        'view' => new Slim\Views\Twig(),
        'templates.path' => App\Config::get('views.path')
    ), App\Config::get('app.custom'))
);
$app->view()->parserOptions = array_merge(array(
    'debug' => App\Config::get('views.debug'),
    'cache' => App\Config::get('views.cachePath')
), App\Config::get('views.custom'));
$app->view()->parserExtensions = array(
    new Slim\Views\TwigExtension()
);

return $app;