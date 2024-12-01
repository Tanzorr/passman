<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVaultRequest;
use App\Http\Requests\UpdateVaultRequest;
use App\Models\Vault;
use Illuminate\Http\JsonResponse;

class VaultController extends Controller
{
    /**
     * @OA\Get(
     *     path="/vaults",
     *     summary="Display a listing of the resource",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
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
     * @OA\Post(
     *     path="/vaults",
     *     summary="Store a newly created resource in storage",
     *     @OA\RequestBody(
     *         required=true,
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Vault created successfully",
     *     )
     * )
     */
    public function store(StoreVaultRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        Vault::create($validatedData);

        return response()->json(['message' => 'Vault created successfully'], 201);
    }

    /**
     * @OA\Get(
     *     path="/vaults/{id}",
     *     summary="Display the specified resource",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     */
    public function show(Vault $vault): JsonResponse
    {
        $vault->load('passwords');

        return response()->json($vault);
    }

    /**
     * @OA\Put(
     *     path="/vaults/{id}",
     *     summary="Update the specified resource in storage",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Vault updated successfully",
     *     )
     * )
     */
    public function update(UpdateVaultRequest $request, Vault $vault): JsonResponse
    {
        $validatedData = $request->validated();

        $vault->where('id', $validatedData['id'])->update($validatedData);

        return response()->json(['message' => 'Vault updated successfully']);
    }

    /**
     * @OA\Delete(
     *     path="/vaults/{id}",
     *     summary="Remove the specified resource from storage",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Vault deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Vault not found"
     *     )
     * )
     */
    public function destroy(Vault $vault): JsonResponse
    {
        if ($vault->delete()) {
            return response(null, 200);
        }

        return response(null, 404);
    }
}
