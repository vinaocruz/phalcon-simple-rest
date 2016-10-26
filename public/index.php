<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../config/main.php';

$app = new \Phalcon\Mvc\Micro($di);

require_once __DIR__ . '/../src/middleware.php';
require_once __DIR__ . '/../src/routes.php';

$app->handle();
