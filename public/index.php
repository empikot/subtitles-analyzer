<?php

if (PHP_SAPI == 'cli-server') {
    $url  = parse_url($_SERVER['REQUEST_URI']);
    if (is_file(__DIR__ . $url['path'])) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';
session_start();

$container = require __DIR__ . '/../src/dependencies.php';
$app = new \Slim\App($container);
require __DIR__ . '/../src/routes.php';
$app->run();
