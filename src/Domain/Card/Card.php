<?php

namespace App\Service;

use App\Entity\Note;
use App\Mapper\MapperInterface;

class NotesService
{
    protected $mapper;

    public function __construct(MapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    public function getAll()
    {
        return $this->mapper->findAll();
    }

    function get($id)
    {
        return $this->mapper->get($id);
    }

    function save(Note $note)
    {
        return $this->mapper->save($note);
    }

    function update(Note $note)
    {
        return $this->mapper->update($note);
    }

    function delete(Note $note)
    {
        return $this->mapper->delete($note);
    }

}
