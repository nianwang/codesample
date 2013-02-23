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
        if (!file_exists($filepath)) {
            $app->notFound();
        }
        $img = new \Sample\Graphics($filepath);

        header('Content-Type: image/png');
        echo $img->crop($width, $height);
        exit;
    }
);

$app->get(
    '/thumb/:image(/:width/:height)', 
    function ($image, $width = 400, $height = 400) use ($app) {
        $filepath = './images/' . $image;
        if (!file_exists($filepath)) {
            $app->notFound();
        }
        $img = new \Sample\Graphics($filepath);

        header('Content-Type: image/png');
        echo $img->thumb($width, $height);
        exit;
    }
);

$app->run();
