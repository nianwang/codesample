<?php

/**
 * Basic routing and configuration.
 */

require_once '../vendor/autoload.php';

$app = new \Slim\Slim(
    [
        'templates.path' => '../templates',
        'debug' => true,
    ]
);

$app->get(
    '/', 
    function () use ($app) {
        // generate list of images
        $images = [];
        for ($i = 1; $i <= 8; $i++) {
            $images[$i] = [
                'id' => $i,
                'orientation' => $i,
                'thumb_uri' => "thumb/thedifference_{$i}.jpg/353/353", 
                'crop_uri' => "crop/thedifference_{$i}.jpg", 
            ];
        }

        // render output
        $data = [
            'images' => $images,
        ];
        echo $app->render('sample.php', $data);
    }
);

$app->get(
    '/crop/:image(/:width/:height)', 
    function ($image, $width = 200, $height = 200) use ($app) {
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
    function ($image, $width = 200, $height = 200) use ($app) {
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
