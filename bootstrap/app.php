<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;

$di = new FactoryDefault();

// Set up the database service
$di->set(
    "db",
    function () use ($config) {
        return new PdoMysql($config['db']);
    }
);
