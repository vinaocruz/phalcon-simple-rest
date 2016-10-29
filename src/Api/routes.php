<?php

use Phalcon\Mvc\Micro\Collection as MicroCollection;
use App\Api\Controller\NotesController;

$app->mount(App\Api\Controller\NotesController::routes(new MicroCollection()));
