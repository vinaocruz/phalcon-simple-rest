<?php

$di = new \Phalcon\Di\FactoryDefault();

$di['config'] = function() use ($config) {
    return $config;
};

