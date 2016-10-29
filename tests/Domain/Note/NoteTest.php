<?php declare(strict_types=1);

namespace Test;

use App\Domain\Note\Note;

/**
 * @group Note
 */
class NoteTest extends \UnitTestCase
{

	public function testCreateNote()
	{

		$input = [
			'description' => 'Notes in tests'
		];

		$note = new Note();

		$noteElement = $note->create($input);

		$this->assertArrayHasKey('id', $noteElement);
		$this->assertArrayHasKey('description', $noteElement);
		$this->assertEquals($input['description'], $noteElement['description']);

		return $noteElement;
		
	}

	/**
	 * @depends testCreateNote
	 */
	public function testUpdateNote(array $note)
	{
		$input = ['description' => 'Nota Velha'];

		$noteElement = new Note();

		$noteRow = $noteElement->update((int)$note['id'], $input);

		$this->assertEquals($input['description'], $noteRow['description']);
		$this->assertEquals($note['id'], $noteRow['id']);

		return $noteRow;
	}

	/**
	 * @depends testUpdateNote
	 */
	public function testGetOneNote(array $note) 
	{
		$noteElement = new Note();

		$noteRow = $noteElement->find((int)$note['id']);

		$this->assertEquals($note['description'], $noteRow['description']);
		$this->assertEquals($note['id'], $noteRow['id']);
	}

	public function testMoreThanOneNote()
	{

		$input = [
			[
				'description' => 'description one'
			],
			[
				'description' => 'description two'
			]
		];

		foreach ($input as $key => $value) {
			$note = new Note();

			$note->create($value);
		};

		$note = new Note();

		$noteRows = $note->all();

		$this->assertTrue(count($noteRows) > 1);
	}

	/**
	 * @depends testCreateNote
	 */
	public function testRemoveNote(array $note)
	{

		$noteElement = new Note();

		$noteRows = $noteElement->delete((int)$note['id']);

		$this->assertTrue($noteRows);

	}

	/**
	 * @expectedException \App\Domain\Note\Exception\NoteNotExistException
	 */
	public function testExceptionCaseNoteNotExist()
	{
		$noteElement = new Note();

		$noteElement->find(0);
	}

	/**
	 * @expectedException \App\Domain\Note\Exception\NoteNotExistException
	 */
	public function testUpdateNoteForNoteNotExist()
	{
		$input = ['description' => 'Nota Velha'];

		$noteElement = new Note();

		$noteElement->update(0, $input);
	}
}





