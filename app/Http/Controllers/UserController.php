<?php

namespace App\Http\Controllers;

use App\Actions\GetUsersAction;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\SharedAccess;
use App\Models\User;
use App\Queries\GetUsersQuery;
use App\Services\SharedAccessService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(
        private SharedAccessService $sharedAccessService,
    ) {}

    public function index(GetUsersAction $getUsersAction): JsonResponse
    {
        $query = new GetUsersQuery(['search' => request('search')]); // Створюємо Query

        return response()->json($getUsersAction->handle($query));
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        return response()->json([
            'message' => 'User created successfully',
            'user' => User::create($request->validated()),
        ]);
    }

    public function show(User $user): JsonResponse
    {
        return response()->json($user);
    }

    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user->update($request->validated()),
        ]);
    }

    public function destroy(User $user): JsonResponse
    {
        return $user->delete() ? response()->json(null, 200) : response()->json(null, 404);
    }

    public function getNotAccessedUsers(string $entityType, string $entityId): JsonResponse
    {
        return response()->json(User::whereNotIn(
            'id',
            $this->sharedAccessService->getSharedAccess(SharedAccess::ACCESS_TYPE_MAP[$entityType], $entityId)
        )
            ->filterBySearch(request('search'))
            ->take(5)
            ->get());
    }
}
