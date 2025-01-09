<?php

namespace App\Http\Controllers\Swagger;

class VaultController
{
    /**
     * @OA\Post(
     *     path="/api/vaults",
     *     summary="Create a new vault",
     *     operationId="createVault",
     *     tags={"Vault"},
     *     security={{"bearerAuth": {}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/StoreVaultRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Vault created successfully",
     *
     *         @OA\JsonContent(
     *             type="object",
     *
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="description", type="string", example="John Doe's vault"),
     *             @OA\Property(property="is_shared", type="boolean", example=false)
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input data",
     *
     *         @OA\JsonContent(
     *             type="object",
     *
     *             @OA\Property(property="message", type="string", example="Invalid input data")
     *         )
     *     )
     * )
     */
    public function store(){}

    /**
     * @OA\Get(
     *     path="/api/vaults",
     *     summary="Get all vaults",
     *     operationId="getVaults",
     *     tags={"Vault"},
     *     security={{"bearerAuth": {}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="List of vaults",
     *
     *         @OA\JsonContent(
     *             type="array",
     *            @OA\Items(ref="#/components/schemas/Vault")
     *         )
     *     )
     * )
     */
    public function index(){}

    /**
     * @OA\Get(
     *     path="/api/vaults/{id}",
     *     summary="Get a single vault",
     *     operationId="getVault",
     *     tags={"Vault"},
     *     security={{"bearerAuth": {}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the vault",
     *         required=true,
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Vault details",
     *
     *         @OA\JsonContent(ref="#/components/schemas/Vault")
     *     )
     * )
     */
    public function show($id){}

    /**
     * @OA\Put(
     *     path="/api/vaults/{id}",
     *     summary="Update a vault",
     *     operationId="updateVault",
     *     tags={"Vault"},
     *     security={{"bearerAuth": {}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the vault",
     *         required=true,
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/UpdateVaultRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Vault updated successfully"
     *     )
     * )
     */
    public function update(){}

    /**
     * @OA\Delete(
     *     path="/api/vaults/{id}",
     *     summary="Delete a vault",
     *     operationId="deleteVault",
     *     tags={"Vault"},
     *     security={{"bearerAuth": {}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the vault",
     *         required=true,
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Vault deleted successfully"
     *     )
     * )
     */
    public function destroy($id){}
}
