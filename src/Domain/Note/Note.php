<?php declare(strict_types=1);

namespace App\Domain\Note;

use App\Domain\Note\Model\Note as NoteModel;
use Phalcon\Mvc\Model\Resultset;
use App\Domain\Note\Exception\NoteNotExistException;

class Note
{

	private $noteRow;

	public function create(array $data) : array
	{
		$noteModel = new NoteModel();

		$this->saveOrUpdate($noteModel, $data);

		return $this->getNoteRow();
	}


	public function update(int $id, array $data) : array
	{

		$noteModel = $this->getNote($id);

		$this->saveOrUpdate($noteModel, $data);

		return $this->getNoteRow();
	}

	public function find(int $id) : array
	{
		$this->setNoteRow($this->getNote($id));

		return $this->getNoteRow();
	}

	public function all() : array
	{
		$noteRows = NoteModel::find();

		return $noteRows->toArray();
	}

	public function delete(int $id) : bool
	{
		$note = $this->getNote($id);

		return $note->delete();
	}

	private function getNote(int $id) : NoteModel
	{
		$note = NoteModel::findFirst('id = ' . $id);

		if (!$note) {
			throw new NoteNotExistException();
			
		}

		return $note;
	}

	private function saveOrUpdate(NoteModel $model, array $data) 
	{

		$model->description = $data['description'];

		$save = $model->save();

		$this->setNoteRow($model);
	}

	private function getNoteRow()
	{
		return $this->noteRow->toArray();
	}

	private function setNoteRow(NoteModel $note)
	{
		$this->noteRow = $note;
	}




}