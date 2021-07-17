<?php

declare(strict_types=1);

namespace App\Model\User\UserCase\Reset\Reset;

class Command
{
    /** @var string */
    public $token;

    /** @var string */
    public $password;

    public function __construct(string $token)
    {
        $this->token = $token;
    }
}
