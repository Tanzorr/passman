<?php

namespace App\Actions;

use App\Http\Requests\StoreSharedAccessRequest;
use App\Models\SharedAccess;
use App\Models\User;

class StoreSharedAccessAction
{
    public function handle(StoreSharedAccessRequest $request): mixed
    {
        $data = $request->validated();
        $data['accessible_type'] = SharedAccess::ACCESS_TYPE_MAP[$data['accessible_type']];
        $sharedAccess = SharedAccess::create($data);

        return User::find($sharedAccess->user_id);
    }
}
