<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePasswordRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\Password;
use App\Models\Vault;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Knuckles\Scribe\Attributes\Endpoint;

class PasswordController extends Controller
{
    public function index(Vault $vault): Collection
    {
        return Password::where('vault_id', $vault->id)->get();
    }

    public function store(StorePasswordRequest $request): JsonResponse
    {
        Password::create($request->validated());

        return response()->json(['message' => 'Password created successfully']);
    }

    public function show(Password $password): Password
    {
        return $password;
    }

    public function update(UpdatePasswordRequest $request, Password $password): JsonResponse
    {
        return response()->json($password->update($request->validated()));
    }

    public function destroy(Password $password): JsonResponse
    {
        $password->delete();

        return response()->json(['message' => 'Password deleted successfully']);
    }
}
