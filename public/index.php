<?php

require '../vendor/autoload.php';

$app = new \Slim\Slim(array(
    'templates.path' => '../templates',
    'debug' => true,
));

$app->get('/', function() use ($app) {
    echo $app->render('sample.php');
});

$app->run();
