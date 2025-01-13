<?php

namespace App\Contracts;

interface MutationActionInterface
{
    public function handle(MutationInterface $mutation): mixed;
}
