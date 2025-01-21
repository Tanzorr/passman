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
    public function index(): JsonResponse
    {
        return response()->json(Password::paginate(20));
    }

    public function store(StorePasswordRequest $request): JsonResponse
    {
        return response()->json(Password::create($request->validated()));
    }

    public function show(Password $password): JsonResponse
    {
        return response()->json($password);
    }

    public function update(UpdatePasswordRequest $request, Password $password): JsonResponse
    {
        return response()->json($password->update($request->validated()));
    }

    public function destroy(Password $password): JsonResponse
    {
        return response()->json(null, $password->delete() ? 200 : 404);
    }
}
