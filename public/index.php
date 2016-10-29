<?php
require_once __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../bootstrap/app.php';

$app->notFound(function () use ($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo 'This is crazy, but this page was not found!';
});

$app->handle();
