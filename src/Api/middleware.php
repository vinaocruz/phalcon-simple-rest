<?php

//ok, this is not a exactly a middleware
$app->notFound(function () use ($app) {
    $app->response->setStatusCode(404);
    $app->response->setJsonContent(['message' => 'Route not found']);

    return $app->response;
});

//check permissions
$app->before(function () use ($app) {

});

$app->error(function (\Exception $e) use ($app) {
    $app->response->setStatusCode($e->getCode());
    $app->response->setJsonContent([
        'error' => true,
        'message' => $e->getMessage(),
        'code' => $e->getCode(),
    ]);

    return $app->response;
});
