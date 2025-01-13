<?php

namespace App\Actions;

use App\Contracts\MutationActionInterface;
use App\Models\SharedAccess;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;

class UpdateSharedAccessAction implements MutationActionInterface
{
    public function handle(ValidatesWhenResolved $request, $id = ''): mixed
    {
        $sharedAccess = SharedAccess::findOrFail($id);
        $sharedAccess->update($request->all());

        return $sharedAccess;
    }
}
