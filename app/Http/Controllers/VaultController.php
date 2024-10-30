<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVaultRequest;
use App\Http\Requests\UpdateVaultRequest;
use App\Models\Vault;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Collection;

class VaultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Collection
    {
        return Vault::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVaultRequest $request): \Illuminate\Http\JsonResponse
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
    public function destroy(Vault $vault): ResponseFactory
    {
        if ($vault->delete()) {
            return response(null, 200);
        }

        return response(null, 404);
    }
}
