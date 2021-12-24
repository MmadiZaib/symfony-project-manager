<?php

declare(strict_types=1);

namespace App\Model\User\Entity\User;

use DateInterval;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Webmozart\Assert\Assert;

/**
 *
 * @ORM\Embeddable()
 */
class ResetToken
{
    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $token;

    /**
     * @var DateTimeImmutable
     *  @ORM\Column(type="date_immutable", nullable=true)
     */
    private $expires;

    public function __construct(string $token, DateTimeImmutable $expires)
    {
        Assert::notEmpty($token);
        $this->token = $token;
        $this->expires = $expires;
    }

    public function isExpiredTo(DateTimeImmutable $date): bool
    {
        $expireDate = $this->expires->add(DateInterval::createFromDateString('+1 day'));

        return $expireDate <= $date;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @internal for postLoad callback
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->token);
    }
}
