<?php

namespace App\Contracts;

interface QueryInterface
{
    public function getParameter(string $key): mixed;
}
