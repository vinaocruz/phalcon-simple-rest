<?php

namespace App\Controller;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Micro\Collection as MicroCollection;

class NotesController extends Controller
{
    public static function routes(MicroCollection $collection)
    {
        $collection->setHandler("App\Controller\NotesController", true);
        $collection->setPrefix('/api/v1');

        $collection->get('/notes', 'fetchAll');

        return $collection;
    }

    public function fetchAll()
    {
        echo "list all";
    }

}
