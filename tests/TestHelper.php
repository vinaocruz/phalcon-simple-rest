<?php

use Phalcon\Di;
use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;

ini_set("display_errors", 1);
error_reporting(E_ALL);

define("ROOT_PATH", __DIR__);

set_include_path(
    ROOT_PATH . PATH_SEPARATOR . get_include_path()
);

// Required for phalcon/incubator
include __DIR__ . "/../vendor/autoload.php";

// Use the application autoloader to autoload the classes
// Autoload the dependencies found in composer
$loader = new Loader();

$loader->registerDirs(
    [
        ROOT_PATH,
    ]
);

$loader->register();

$dotenv = new Dotenv\Dotenv(__DIR__.'/../');
$dotenv->load();

$di = new FactoryDefault();

Di::reset();

$config = require __DIR__ .'/../config/database.php';

$di->set(
    "db",
    function () use ($config) {
        return new PdoMysql($config['mysql']);
    }
);

// Add any needed services to the DI here

Di::setDefault($di);
