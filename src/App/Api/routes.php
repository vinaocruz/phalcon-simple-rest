<?php

use \Phalcon\Mvc\Micro\Collection as MicroCollection;

$app->mount(App\Controller\NotesController::routes($app, new MicroCollection()));