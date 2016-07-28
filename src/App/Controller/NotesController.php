<?php

namespace App\Controller;

use \Phalcon\Mvc\Micro\Collection as MicroCollection;

class NotesController extends AbstractController
{
    public static function routes(\Phalcon\Mvc\Micro $app, MicroCollection $collection)
    {
        $collection->setHandler(__CLASS__, true);
        $collection->setPrefix($app['config']['api.endpoint'] . $app['config']['api.version'] . '/notes');

        $collection->get('/', 'fetchAll');

        return $collection;
    }

    public function fetchAll()
    {
        $this->response->setJsonContent($this->notes->getAll());
        return $this->response;
    }

}
