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
        return response()->json($sharedAccessAction->handle($request), 201);
    }

    public function update(
        string $id,
        UpdateSharedAccessRequest $request,
        UpdateSharedAccessAction $sharedAccessAction
    ): JsonResponse {
        return response()->json($sharedAccessAction->handle($request, $id), 200);
    }

    public function destroy(string $id): JsonResponse
    {
        SharedAccess::destroy($id);

        return response()->json(null, 200);
    }
}
