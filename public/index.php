<?php

/**
 * Basic routing and configuration.
 */

require_once '../vendor/autoload.php';

$app = new \Slim\Slim(
    array(
        'templates.path' => '../templates',
        'debug' => true,
    )
);

$app->get(
    '/', 
    function () use ($app) {
        echo $app->render('sample.php');
    }
);

$app->get(
    '/crop/:image(/:width/:height)', 
    function ($image, $width = 400, $height = 400) use ($app) {
        $filepath = './images/' . $image;

        $graphics = new \Sample\Graphics($filepath);
        if ($image = $graphics->crop($width, $height)) {
            // only prepare output if we have a good op
            header('Content-Type: image/png');
            echo $image;
            exit;
        }
        $app->notFound();
    }
);

$app->get(
    '/thumb/:image(/:width/:height)', 
    function ($image, $width = 400, $height = 400) use ($app) {
        $filepath = './images/' . $image;

        $graphics = new \Sample\Graphics($filepath);
        if ($image = $graphics->thumb($width, $height)) {
            // only prepare output if we have a good op
            header('Content-Type: image/png');
            echo $image;
            exit;
        }
        $app->notFound();
    }
);

$app->run();
