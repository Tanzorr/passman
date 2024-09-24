<?php

namespace App\Actions;

use App\Http\Requests\StoreSharedAccessRequest;
use App\Models\SharedAccess;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class StoreSharedAccessAction
{
    public function handle(StoreSharedAccessRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['accessible_type'] = SharedAccess::ACCESS_TYPE_MAP[$data['accessible_type']];
        $sharedAccess = SharedAccess::create($data);
        $accessedUser = User::find($sharedAccess->user_id);

        return response()->json($accessedUser);
    }
}
