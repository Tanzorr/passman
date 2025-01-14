<?php

namespace App\Http\Controllers;

use App\Actions\GetVaultsAction;
use App\Http\Requests\StoreVaultRequest;
use App\Http\Requests\UpdateVaultRequest;
use App\Models\Vault;
use App\Queries\GetQuery;
use Illuminate\Http\JsonResponse;

class VaultController extends Controller
{
    public function index(GetVaultsAction $getVaultsAction): JsonResponse
    {
        return response()->json($getVaultsAction->handle(new GetQuery(['search' => request('search')])));
    }

    public function store(StoreVaultRequest $request): JsonResponse
    {
        Vault::create($request->validated());

        return response()->json(['message' => 'Vault created successfully'], 201);
    }
    public function show(Vault $vault): JsonResponse
    {
        return response()->json($vault->load(['passwords', 'sharedAccess', 'accessedUsers']));
    }

    public function update(UpdateVaultRequest $request, Vault $vault): JsonResponse
    {
        $vault->update($request->validated());

        return response()->json(['message' => 'Vault updated successfully']);
    }

    public function destroy(Vault $vault): JsonResponse
    {
        return response()->json(null, $vault->delete() ? 200 : 404);
    }
}
