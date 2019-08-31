<?php

use Slim\Slim;

require 'vendor/autoload.php';
require 'app/const.php';

Slim::registerAutoloader();

$app = new Slim();

$app->get('/currencies', function() {
    
});

$app->get('/currency', function() {
    
});

$app->get('/parse', function() {
    require('app/cli/parse_valutes.php');
});

$app->run();
