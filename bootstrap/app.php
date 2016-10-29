<?php

use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;

$di = new FactoryDefault();

$dotenv = new Dotenv\Dotenv(__DIR__.'/../');
$dotenv->load();

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

$di->set(
    "config",
    function () {
        return 
            [
                'api.version' => getenv(API_VERSION)
            ];
    }
);

$app = new Micro($di);
