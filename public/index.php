<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../config/main.php';
require_once __DIR__ . '/../bootstrap/app.php';

$app = new Phalcon\Mvc\Micro($di);

require_once __DIR__ . '/../src/Api/middleware.php';
require_once __DIR__ . '/../src/Api/routes.php';

$app->handle();
