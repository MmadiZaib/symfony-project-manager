<?php

declare(strict_types=1);

namespace App\Security;

use App\ReadModel\User\AuthView;
use App\ReadModel\User\UserFetcher;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use function get_class;

class UserProvider implements UserProviderInterface
{
    private $users;

    public function __construct(UserFetcher $users)
    {
        $this->users = $users;
    }

    public function loadUserByUsername($username)
    {
        $user = $this->loadUser($username);

        return self::identityByUser($user);
    }

    public function refreshUser(UserInterface $userIdentity)
    {
        if (!$userIdentity instanceof UserIdentity) {
            throw new UnsupportedUserException('Invalid user class ' . get_class($userIdentity));
        }

        return $userIdentity;
    }

    public function supportsClass($class): bool
    {
        return $class === UserIdentity::class;
    }

    public function loadUser(string $username): AuthView
    {
        if (!$user = $this->users->findForAuth($username)) {
            throw new UsernameNotFoundException('');
        }

        return $user;
    }

    public static function identityByUser(AuthView $user): UserIdentity
    {
        return new UserIdentity(
            $user->id,
            $user->email,
            $user->password_hash,
            $user->role,
            $user->status
        );
    }
}
