<?php

namespace App\Contracts;

interface MutationInterface
{
    public function getParameter(mixed $parameter): mixed;
}
