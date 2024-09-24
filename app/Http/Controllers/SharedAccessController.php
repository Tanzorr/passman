<?php

namespace App\Http\Controllers;

use App\Actions\StoreSharedAccessAction;
use App\Actions\UpdateSharedAccessAction;
use App\Http\Requests\StoreSharedAccessRequest;
use App\Models\SharedAccess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    public function update(Request $request, string $id, UpdateSharedAccessAction $sharedAccessAction): JsonResponse
    {
        return $sharedAccessAction->handle($request, $id);
    }

    public function destroy(string $id): JsonResponse
    {
        SharedAccess::destroy($id);

        return response()->json(null, 200);
    }
}
