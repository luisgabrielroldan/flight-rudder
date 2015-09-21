<?php

include 'vendor/autoload.php';

include 'controllers/TestController.php';

use rudder\Engine;

$app = new Engine();

$app->route('/', function(){
    echo 'hello world!';
});

$app->controller(TestController::classname());

$app->start();