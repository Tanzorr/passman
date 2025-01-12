<?php

namespace App\Queries;

use App\Contracts\QueryInterface;

class GetUsersQuery implements QueryInterface
{

    public function __construct(private array $parameters = [])
    {
        $this->parameters = $parameters;
    }

    public function getParameter(string $key): mixed
    {
        return $this->parameters[$key] ?? null;
    }
}
