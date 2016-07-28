<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../resource/config/main.php';
require_once __DIR__ . '/../src/dependencies.php';

$app = new \Phalcon\Mvc\Micro($di);

require_once __DIR__ . '/../src/routes.php';

$app->handle();
