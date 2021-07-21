<?php

declare(strict_types=1);

namespace App\Security;

use Symfony\Component\Security\Core\Exception\AccountStatusException;
use Symfony\Component\Security\Core\Exception\DisabledException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{

    public function checkPreAuth(UserInterface $userIdentity)
    {
        if (!$userIdentity instanceof UserIdentity) {
            return;
        }

        if (!$userIdentity->isActive()) {
            $exception = new DisabledException('User account is disabled.');
            $exception->setUser($userIdentity);
            throw $exception;
        }
    }

    public function checkPostAuth(UserInterface $user)
    {

    }
}
