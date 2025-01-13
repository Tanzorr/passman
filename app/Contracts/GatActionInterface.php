<?php

namespace App\Contracts;

use Illuminate\Contracts\Validation\ValidatesWhenResolved;

interface GatActionInterface
{
    public function handle(QueryInterface $query): mixed;
}
