<?php

declare(strict_types=1);

namespace App\Model\User;

interface EventDispatcher
{
    public function dispatch(array $events): void;
}
