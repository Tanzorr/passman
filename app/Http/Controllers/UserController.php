<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

/**
 * @OA\Info(
 *     title="Pass Manager API",
 *     version="1.0.0",
 *     description="Документация API для Pass Manager"
 * )
 */
class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/users",
     *     summary="Display a listing of the resource",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        $search = request()->get('search');

        $users = User::filterBySearch($search)
            ->orderBy('created_at', 'desc')
            ->paginate();

        return response()->json($users);
    }

    /**
     * @OA\Post(
     *     path="/users",
     *     summary="Store a newly created resource in storage",
     *     @OA\RequestBody(
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User created successfully"
     *     )
     * )
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $user = User::create($validatedData);

        return response()->json(['message' => 'User created successfully', 'user' => $user]);
    }

    /**
     * @OA\Get(
     *     path="/users/{id}",
     *     summary="Display the specified resource",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     )
     * )
     */
    public function show(User $user): JsonResponse
    {
        $user->load('vaults');

        return response()->json($user);
    }

    /**
     * @OA\Put(
     *     path="/users/{id}",
     *     summary="Update the specified resource in storage",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User updated successfully"
     *     )
     * )
     */
    public function update(UpdateUserRequest $request, string $id): RedirectResponse
    {
        $validatedData = $request->validated();

        User::where('id', $id)->update($validatedData);

        return redirect()->back()->with('success', 'User updated successfully!');
    }

    /**
     * @OA\Delete(
     *     path="/users/{id}",
     *     summary="Remove the specified resource from storage",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     )
     * )
     */
    public function destroy(string $id): mixed
    {
        if (User::destroy($id)) {
            return response(null, 200);
        }

        return response(null, 404);
    }
}
