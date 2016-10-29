<?php namespace App\Api\Controller;

use Phalcon\Mvc\Micro\Collection as MicroCollection;
use App\Domain\Note\Note;
use App\Domain\Note\Validation\NoteValidation;
use App\Domain\Note\Exception\NoteNotExistException;


class NotesController extends AbstractController
{

    public static function routes(MicroCollection $collection)
    {
        $collection->setHandler(__CLASS__, true);
        $collection->setPrefix('/notes');

        $collection->get('/', 'all');
        $collection->get('/{id}', 'get');
        $collection->post('/', 'save');
        $collection->put('/{id}', 'update');
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
        $note = new Note();

        $this->response->setJsonContent(
            [
                'status' => 'Ok',
                'messages' => $note->all()
            ]
        );
        return $this->response;
    }

    public function get($id)
    {
        try{
            $note = new Note();

            $this->response->setJsonContent(
                [
                    'status' => 'Ok',
                    'messages' => $note->find($id)
                ]
            );
        } catch (NoteNotExistException $e) {
            
            $this->response->setStatusCode(404, "Not Found");
            $this->response->setJsonContent(
                [
                    'status' => 'false',
                    'messages' => $e->getMessage()
                ]
            );
        } finally
        {
            return $this->response;
        }


    }

    public function save()
    {
        
        $input = $this->getDataFromRequest();

        $validation = new NoteValidation();

        //var_dump(get_class_methods($validation));exit;

        $messages = $validation->validate($input);

        if(count($messages)) {

            $this->response->setStatusCode(409, "Conflict");

            $error = [];

            foreach ($messages as $message) {
                $error[] = $message->getMessage();
            };

            $this->response->setJsonContent(
                [
                    "status"   => "ERROR",
                    "messages" => $error,
                ]
            );
        } else {

            $note = new Note();

            $status = $note->create($input);

            $this->response->setStatusCode(201, "Create");

            $this->response->setJsonContent(
                [
                    'status' => 'ok',
                    'messages' => $status
                ]
            );

        };

        //$this->response->setJsonContent($note);
        return $this->response;
    }

    public function update($id)
    {
        try {
            $input = $this->request->getPut();

            $validation = new NoteValidation();

            $messages = $validation->validate($input);

            if(count($messages)) {

                $this->response->setStatusCode(409, "Conflict");

                $error = [];

                foreach ($messages as $message) {
                    $error[] = $message->getMessage();
                };

                $this->response->setJsonContent(
                    [
                        "status"   => "ERROR",
                        "messages" => $error,
                    ]
                );
            } else {

                $note = new Note();

                $status = $note->update($id, $input);

                $this->response->setStatusCode(200, "Ok");

                $this->response->setJsonContent(
                    [
                        'status' => 'ok',
                        'messages' => $status
                    ]
                );

            };

        } catch (NoteNotExistException $e) {
            
            $this->response->setStatusCode(409, "Conflict");
            $this->response->setJsonContent(
                [
                    'status' => 'false',
                    'messages' => $e->getMessage()
                ]
            );
        } finally
        {
            return $this->response;
        }

    }

    public function delete($id)
    {


        try {
            $note = new Note();

            $status = $note->delete($id);

            $this->response->setJsonContent(
                [
                    'status' => 'ok',
                    'messages' => $status
                ]
            );

        } catch (NoteNotExistException $e) {
            $this->response->setStatusCode(409, "Conflict");
            $this->response->setJsonContent(
                [
                    'status' => 'false',
                    'messages' => $e->getMessage()
                ]
            );
        } finally
        {
            return $this->response;
        }
        
    }

    protected function getDataFromRequest()
    {
        return [
            "description" => $this->request->get("description")
        ];
    }
}
