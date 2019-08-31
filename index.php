<?php

use Slim\Slim;

require 'vendor/autoload.php';

Slim::registerAutoloader();
$app = new Slim();

$app->get('/currencies', function() {});

$app->get('/currency', function() {});

$app->get('/parse', function() {
    require 'app/cli/parse_valute.php';
});

$app->run();
