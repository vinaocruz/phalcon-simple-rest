<?php

use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;

$di = new FactoryDefault();

$dotenv = new Dotenv\Dotenv(__DIR__.'/../');
$dotenv->load();

$config = require __DIR__ .'/../config/database.php';

$di->set(
    "config",
    function () {
        return $config;
    }
);

$di->set(
    "db",
    function () use ($config) {
        return new PdoMysql($config['mysql']);
    }
);

$app = new Micro($di);

require __DIR__ . '/../src/Api/routes.php';
