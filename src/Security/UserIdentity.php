<?php

declare(strict_types=1);

namespace App\Security;

use Symfony\Component\Security\Core\User\UserInterface;

class UserIdentity implements UserInterface
{
    private $id;
    private $username;
    private $password;
    private $role;

    public function __construct(
        string $id,
        string $username,
        string $password,
        string $role
    )
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getRoles(): array
    {
        return [$this->role];
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
    }
}
