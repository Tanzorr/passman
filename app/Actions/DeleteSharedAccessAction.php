<?php

namespace App\Actions;

use App\Http\Requests\StoreSharedAccessRequest;
use App\Models\SharedAccess;
use Illuminate\Http\JsonResponse;

class DeleteSharedAccessAction
{

    public function handle(StoreSharedAccessRequest $request, $typeMapping): JsonResponse
    {
        SharedAccess::where('accessible_type', $typeMapping[$request->validated()['accessible_type']])
            ->where('accessible_id', $request->validated()['accessible_id'])
            ->where('user_id', $request->validated()['user_id'])
            ->first()
            ->delete();

        return response()->json(['message' => 'Access removed successfully']);
    }
}
