<?php declare(strict_types=1);

namespace App\Domain\Note\Validation;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;

class NoteValidation extends Validation
{
	public function initialize()
    {
        $this->add(
            "description",
            new PresenceOf(
                [
                    "message" => "The description is required",
                ]
            )
        );
    }
}