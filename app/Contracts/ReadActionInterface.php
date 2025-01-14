<?php

namespace App\Contracts;

use Illuminate\Contracts\Validation\ValidatesWhenResolved;

interface ReadActionInterface
{
    public function handle(QueryInterface $query): mixed;
}
