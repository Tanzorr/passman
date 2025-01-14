<?php

namespace App\Actions;

use App\Contracts\MutationActionInterface;
use App\Models\SharedAccess;

class UpdateSharedAccessAction implements MutationActionInterface
{
    public function handle(array $data): mixed
    {
        $sharedAccess = SharedAccess::findOrFail($data['id']);
        $sharedAccess->update($data['attributes']);

        return $sharedAccess;
    }
}
