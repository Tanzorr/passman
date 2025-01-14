<?php

namespace App\Http\Controllers;

use App\Actions\StoreSharedAccessAction;
use App\Actions\UpdateSharedAccessAction;
use App\Http\Requests\StoreSharedAccessRequest;
use App\Http\Requests\UpdateSharedAccessRequest;
use App\Models\SharedAccess;
use Illuminate\Http\JsonResponse;

class SharedAccessController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(SharedAccess::all());
    }

    public function store(StoreSharedAccessRequest $request, StoreSharedAccessAction $sharedAccessAction): JsonResponse
    {
        return response()->json($sharedAccessAction->handle($request->all()), 201);
    }

    public function update(
        string $id,
        UpdateSharedAccessRequest $request,
        UpdateSharedAccessAction $sharedAccessAction
    ): JsonResponse {
        return response()->json($sharedAccessAction->handle(['attributes' => $request->all(), 'id' => $id]), 200);
    }

    public function destroy(SharedAccess $sharedAccess): JsonResponse
    {
        return response()->json(null, $sharedAccess->delete() ? 200 : 404);
    }
}
