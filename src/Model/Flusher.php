<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\User\AggregateRoot;
use App\Model\User\EventDispatcher;
use Doctrine\ORM\EntityManagerInterface;

class Flusher
{
    private $em;
    private $dispatcher;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
       // $this->dispatcher = $dispatcher;
    }

    public function flush(AggregateRoot ...$roots): void
    {
        $this->em->flush();

/*        foreach ($roots as $root) {
            $this->dispatcher->dispatch($root->releaseEvents());
         }*/
    }
}
