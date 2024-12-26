<?php

namespace App\Http\Controllers;

use App\Actions\GetUsersAction;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\SharedAccess;
use App\Models\User;
use App\Services\ImageUploadService;
use App\Services\SharedAccessService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct(private SharedAccessService $sharedAccessService, private ImageUploadService $imageUploadService)
    {
    }

    public function index(GetUsersAction $getUsersAction): JsonResponse
    {
        return $getUsersAction->handle(request('search'));
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('user_images');
        }

        $user = User::create($validated);

        $path = $request->file('image')->store('user_images');

        return response()->json(['message' => 'User created successfully', 'user' => $user,
            'image_path' => $path]);
    }

    public function show(User $user): JsonResponse
    {
        return response()->json($user);
    }

    public function update(UpdateUserRequest $request, string $id): JsonResponse
    {
        $user = User::findOrFail($id);
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $imageUrl = $this->imageUploadService->upload($request->file('image'));

            $validated['image'] = $imageUrl;
        }

        $user->update($validated);

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user,
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        $user = User::findOrFail($id);

        if ($user->image) {
            Storage::delete($user->image);
        }

        return $user->delete() ? response()->json(null, 200) : response()->json(null, 404);
    }

    public function getNotAccessedUsers(string $entityType, string $entityId): JsonResponse
    {
        return $this->sharedAccessService
            ->getNotAccessedUsers(SharedAccess::ACCESS_TYPE_MAP[$entityType], $entityId, request('search'));
    }
}
