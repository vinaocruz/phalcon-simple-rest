<?php namespace App\Api\Controller;

use \Phalcon\Mvc\Micro\Collection as MicroCollection;

class NotesController extends AbstractController
{

    public static function routes(MicroCollection $collection)
    {
        $collection->setHandler(__CLASS__, true);
        $collection->setPrefix('/notes');

        $collection->get('/', 'all');
        $collection->get('/{id}', 'get');
        $collection->post('/', 'save');
        $collection->patch('/{id}', 'update');
        $collection->delete('/{id}', 'delete');
        return $collection;
    }

    //test data
    protected $data = [
        [
            'message' => 'Hello',
            'author' => 'John',
        ],
        [
            'message' => 'World',
            'author' => 'Lennon',
        ],
    ];

    public function all()
    {
        $this->response->setJsonContent($this->data);
        return $this->response;
    }

    public function get($id)
    {
        $this->response->setJsonContent($this->data[$id]);
        return $this->response;
    }

    public function save()
    {
        $note = $this->getDataFromRequest();

        $this->response->setJsonContent($note);
        return $this->response;
    }

    public function update($id)
    {
        $note = $this->getDataFromRequest();

        $this->response->setJsonContent($note);
        return $this->response;
    }

    public function delete($id)
    {
        $this->response->setJsonContent(true);
        return $this->response;
    }

    public function getDataFromRequest()
    {
        return [
            "note" => $this->request->get("note")
        ];
    }
}
