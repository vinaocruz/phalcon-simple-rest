<?php

use \Phalcon\Mvc\Micro\Collection as MicroCollection;

$app->mount(Api\Controller\NotesController::routes(new MicroCollection()));
