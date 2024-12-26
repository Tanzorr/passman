<?php

namespace App\Actions;

use App\Http\Requests\StoreSharedAccessRequest;
use App\Http\Requests\UpdateSacrednessRequest;
use App\Models\SharedAccess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateSharedAccessAction
{
    public function handle(UpdateSacrednessRequest $request, string $id): JsonResponse
    {
        $sharedAccess = SharedAccess::findOrFail($id);
        $sharedAccess->update($request->all());

        return response()->json('shared access updated', 200);
    }
}
