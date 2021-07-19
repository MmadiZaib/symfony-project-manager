<?php

namespace App\Model\User;

interface AggregateRoot
{
    public function releaseEvents() : array;
}
