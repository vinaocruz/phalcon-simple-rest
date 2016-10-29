<?php declare(strict_types=1);

namespace App\Domain\Note\Exception;

class NoteNotExistException extends \RuntimeException
{
    public function __construct($message = 'Note does not exist')
    {
        parent::__construct($message);
    }
}