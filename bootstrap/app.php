<?php

use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;

$di = new FactoryDefault();

// Set up the database service
$di->set(
    "db",
    function () {
        return new PdoMysql(
            [
                "host"     => "172.17.0.1:33060",
                "username" => "root",
                "password" => "dev123",
                "dbname"   => "my_app",
            ]
        );
    }
);

// Create and bind the DI to the application
$app = new Micro($di);
