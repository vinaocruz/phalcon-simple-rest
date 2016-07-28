<?php

$di = new \Phalcon\Di\FactoryDefault();

$di['config'] = function() use ($config) {
    return $config;
};

$di->set('notes', function () {
    return new \App\Service\NotesService(new \App\Mapper\NotesMapper());
});
