<?php

namespace App\Contracts;

interface GatActionInterface
{
    public function handle(QueryInterface $query): mixed;
}
