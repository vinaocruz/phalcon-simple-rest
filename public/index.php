<?php

require_once __DIR__ . '/../vendor/autoload.php';

//require_once __DIR__ . '/../config/main.php';

require __DIR__ . '/../bootstrap/app.php';

$app->get(
    "/",
    function () {
    	echo json_encode(['data' => 'teste']);
    }
);

//require_once __DIR__ . '/../src/middleware.php';
//require_once __DIR__ . '/../src/routes.php';

$app->handle();
