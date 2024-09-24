<?php

namespace App\Actions;

use App\Models\SharedAccess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateSharedAccessAction
{
    public function handle(Request $request, string $id): JsonResponse
    {
        $sharedAccess = SharedAccess::findOrFail($id);
        $sharedAccess->update($request->all());

        return response()->json('shared access updated', $sharedAccess);
    }
}
