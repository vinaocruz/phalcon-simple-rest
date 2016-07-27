<?php

use Phalcon\Mvc\Micro\Collection as MicroCollection;
use App\Controller\NotesController;

$app->mount(NotesController::routes(new MicroCollection()));