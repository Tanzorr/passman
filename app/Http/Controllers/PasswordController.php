<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePasswordRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\Password;
use App\Models\Vault;
use Illuminate\Http\JsonResponse;

class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Vault $vault): \Illuminate\Database\Eloquent\Collection
    {
        return Password::where('vault_id', $vault->id)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePasswordRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        Password::create($validatedData);

        return response()->json(['message' => 'Password create successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Password $password): Password
    {
        return $password;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePasswordRequest $request, Password $password): JsonResponse
    {
        $validatedData = $request->validated();

        $password->where($validatedData['id'] === 'id')->update($validatedData);

        return response()->json(['message' => 'Password updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Password $password): JsonResponse
    {
        $password->delete();

        return response()->json(['message' => 'Password deleted successfully']);
    }
}
