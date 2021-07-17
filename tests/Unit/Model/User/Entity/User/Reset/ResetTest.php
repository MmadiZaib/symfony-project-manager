<?php

namespace App\Tests\Unit\Model\User\Entity\User\Reset;

use App\Model\User\Entity\User\ResetToken;
use App\Tests\Builder\User\UserBuilder;
use PHPUnit\Framework\TestCase;

class ResetTest extends TestCase
{
    public function testSuccess(): void
    {
        $now = new \DateTimeImmutable();
        $token = new ResetToken('token', $now->modify('+1 day'));

        $user = (new UserBuilder())->viaEmail()-> confirmed()->build();
        $user->requestPasswordReset($token, $now);

        $this->assertNotNull($user->getResetToken());

        $user->passwordReset($now, $hash = 'hash');

        $this->assertNotNull($user->getResetToken());
        $this->assertEquals($hash, $user->getPasswordHash());
    }

    public function testExpiredToken(): void
    {
        $now = new \DateTimeImmutable();
        $token = new ResetToken('token', $now);

        $user = (new UserBuilder())->viaEmail()->confirmed()->build();
        $user->requestPasswordReset($token, $now);

        $this->expectExceptionMessage('Reset token is expired.');
        $user->passwordReset($now->modify('+1 day'), 'hash');
    }



    public function testNotRequested(): void
    {
        $now = new \DateTimeImmutable();
        $user = (new UserBuilder())->viaEmail()->build();

        $this->expectExceptionMessage('Resetting is not requested.');
        $user->passwordReset($now, 'hash');
    }
}
