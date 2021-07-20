<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\User\AggregateRoot;
use App\Model\User\EventDispatcher;
use Doctrine\ORM\EntityManagerInterface;

class Flusher
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function flush(AggregateRoot ...$roots): void
    {
        $this->em->flush();
    }
}
