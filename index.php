<?php

use Slim\Slim;

require 'app/bootstrap.php';

Slim::registerAutoloader();
$app = new Slim();

require 'app/routes.php';

$app->run();
