<?php

namespace App\Actions;

use App\Contracts\MutationActionInterface;
use App\Models\SharedAccess;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use App\Contracts\QueryInterface;

class StoreSharedAccessAction implements MutationActionInterface
{
    public function handle(array $data): mixed
    {
        $data['accessible_type'] = SharedAccess::ACCESS_TYPE_MAP[$data['accessible_type']];
        $sharedAccess = SharedAccess::create($data);

        return User::find($sharedAccess->user_id);
    }
}
