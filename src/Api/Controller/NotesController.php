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
        $collection->get('/{id}', 'fetch');
        $collection->post('/', 'save');
        $collection->put('/{id}', 'update');
        $collection->delete('/{id}', 'delete');

        return $collection;
    }

    public function fetchAll()
    {
        $this->response->setJsonContent($this->notes->getAll());
        return $this->response;
    }

    public function fetch($id)
    {
        $this->response->setJsonContent($this->notes->get($id));
        return $this->response;
    }

    public function save()
    {
        $note = $this->getDataFromRequest();

        $this->response->setJsonContent(["id" => $this->notes->save($note)]);
        return $this->response;

    }

    public function update($id)
    {
        $note = $this->getDataFromRequest();
        $this->notes->update($id, $note);

        $this->response->setJsonContent($note);
        return $this->response;
    }

    public function delete($id)
    {
        $this->response->setJsonContent($this->notes->delete($id));
        return $this->response;
    }

    public function getDataFromRequest()
    {
        return [
            "note" => $this->request->getPost("note")
        ];
    }
}
