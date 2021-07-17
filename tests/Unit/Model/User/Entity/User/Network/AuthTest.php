<?php

declare(strict_types=1);

namespace App\Tests\Unit\Model\User\Entity\User\Network;

use App\Model\User\Entity\User\Email;
use App\Model\User\Entity\User\Id;
use App\Model\User\Entity\User\Network;
use App\Model\User\Entity\User\User;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = new User(Id::next(), new DateTimeImmutable());
        $user->signUpByNetwork(
            $network = 'vk',
            $identity = '00001'
        );

        $this->assertTrue($user->isActive());
        $this->assertCount(1, $networks = $user->getNetworks());
        $this->assertInstanceOf(Network::class, $first = reset($networks));
        $this->assertEquals($network, $first->getNetwork());
        $this->assertEquals($identity, $first->getIdentity());
    }

    public function testAlready(): void
    {
        $user = new User(
            $id = Id::next(),
            $date = new DateTimeImmutable()
        );


        $user->signUpByEmail(
            $email = new Email('test@app.test'),
            $hash = 'hash',
            $token = 'token'
        );

        $this->expectExceptionMessage('User is already signed up');
        $user->signUpByEmail($email, $hash, $token);
    }
}
