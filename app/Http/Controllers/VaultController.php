<?php

namespace App\Http\Controllers;

use App\Actions\GetVaultsAction;
use App\Http\Requests\StoreVaultRequest;
use App\Http\Requests\UpdateVaultRequest;
use App\Models\Vault;
use Illuminate\Http\JsonResponse;

class VaultController extends Controller
{
    public function index(GetVaultsAction $getVaultsAction): JsonResponse
    {
        return $getVaultsAction->handle(request()->get('search'));
    }

    public function store(StoreVaultRequest $request): JsonResponse
    {
        Vault::create($request->validated());

        return response()->json(['message' => 'Vault created successfully'], 201);
    }
    public function show(Vault $vault): JsonResponse
    {
        $vault->load(['passwords', 'sharedAccess', 'accessedUsers']);

        return response()->json($vault);
    }

    public function update(UpdateVaultRequest $request, Vault $vault): JsonResponse
    {
        $vault->where('id', $request->validated()['id'])->update($request->validated());

        return response()->json(['message' => 'Vault updated successfully']);
    }

    public function destroy(Vault $vault): JsonResponse
    {
        return response()->json(null, $vault->delete() ? 200 : 404);
    }
}
