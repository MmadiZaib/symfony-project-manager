<?php

declare(strict_types=1);

namespace App\Model\User\UserCase\SignUp\Confirm;

use App\Model\Flusher;
use App\Model\User\Entity\User\UserRepository;
use DomainException;

class Handler
{
    private $users;
    private $flusher;

    public function __construct(UserRepository $users, Flusher $flusher)
    {
        $this->users = $users;
        $this->flusher = $flusher;
    }

    public function handle(Command $command): void
    {
        if (!$user = $this->users->findByConfirmToken($command->token)) {
            throw new DomainException('Incorrect or confirmed token.');
        }

        $user->confirmSignUp();
        $this->flusher->flush();
    }
}
