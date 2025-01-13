<?php

namespace App\Contracts;

use Illuminate\Contracts\Validation\ValidatesWhenResolved;

interface MutationActionInterface
{
    public function handle(ValidatesWhenResolved $request, $id = ''): mixed;
}
