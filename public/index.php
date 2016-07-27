<?php
require_once __DIR__ . '/../vendor/autoload.php';

$app = new Phalcon\Mvc\Micro();

require __DIR__ . '/../src/routes.php';

$app->handle();
