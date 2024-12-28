<?php

namespace App\Http\Controllers;

use App\Actions\StoreSharedAccessAction;
use App\Actions\UpdateSharedAccessAction;
use App\Http\Requests\StoreSharedAccessRequest;
use App\Http\Requests\UpdateSacrednessRequest;
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
        return $sharedAccessAction->handle($request);
    }

    public function update(UpdateSacrednessRequest $request, string $id, UpdateSharedAccessAction $sharedAccessAction): JsonResponse
    {
        return $sharedAccessAction->handle($request, $id);
    }

    public function destroy(string $id): JsonResponse
    {
        SharedAccess::destroy($id);

        return response()->json(null, 200);
    }
}
