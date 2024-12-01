<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVaultRequest;
use App\Http\Requests\UpdateVaultRequest;
use App\Models\Vault;
use Illuminate\Http\JsonResponse;

class VaultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $search = request()->get('search');

        $vaults = Vault::filterBySearch($search)
            ->orderBy('created_at')
            ->paginate(18);


        return response()->json($vaults);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVaultRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        Vault::create($validatedData);

        return response()->json(['message' => 'Vault created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vault $vault): \Illuminate\Http\JsonResponse
    {
        $vault->load('passwords');

        return response()->json($vault);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVaultRequest $request, Vault $vault): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validated();

        $vault->where('id', $validatedData['id'])->update($validatedData);

        return response()->json(['message' => 'Vault updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vault $vault)
    {
        if ($vault->delete()) {
            return response(null, 200);
        }

        return response(null, 404);
    }
}
