<?php

use Mvc\Front;

$app->get('/currencies(/:count(/:page))', function($count = null, $page = 1) {
    $frontController = new Front([
        'controller' => 'Currencies',
        'method' => 'exec',
        'params' => [
            'count' => $count,
            'page' => $page
            ]
        ]);
    $frontController->init();
});

$app->get('/currency(/:id)', function($id = 1) {
    $frontController = new Front([
        'controller' => 'Currency',
        'method' => 'exec',
        'params' => [
            'id' => $id
            ]
        ]);
    $frontController->init();
});
    
$app->get('/parse', function() {
    require 'app/cli/parse_valute.php';
});